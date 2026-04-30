<?php
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Models/Comentario.php';
require_once __DIR__ . '/../Models/Puntuacion.php';
require_once __DIR__ . '/../Models/Etiqueta.php';
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/ComentarioController.php';

class ObraController {
    public function catalogo() {
        $busqueda=$_GET['parametro'] ?? null;
        $genero=$_GET['genero'] ?? null;
        $autor=$_GET['autor'] ?? null;
        $epoca=$_GET['epoca'] ?? null;
        $pagina=(int)($_GET['pagina'] ?? 1);
        $porPagina=(int)($_GET['porPagina'] ?? 15);

        $obras=$busqueda ? Obra::buscarTodo($busqueda) : Obra::cargarTodas();
        $autores=Autor::cargarTodos();

        if(!$obras) {
            $obras=[];
        }

        if($genero) {
            $obras=array_filter($obras, function($obra) use ($genero) {
                return $obra['genero'] === $genero;
            });
        }

        if($autor) {
            $obras=array_filter($obras, function($obra) use ($autor) {
                return $obra['autor'] === $autor;
            });
        }

        if($epoca) {
            $obras=array_filter($obras, function($obra) use ($epoca) {
                $anio=$obra['anio_publicacion'];
                return ceil($anio / 100) == $epoca;
            });
        }

        $obras=array_values($obras);

        $total=count($obras);
        $totalPaginas=ceil($total / $porPagina);
        $obras=array_slice($obras, ($pagina - 1) * $porPagina, $porPagina);

        $title="Catálogo";
        
        $resultados=[
            'obras' => $obras,
            'total' => $total,
            'totalPaginas' => $totalPaginas,
            'pagina' => $pagina,
            'porPagina' => $porPagina
        ];

        ob_start();
        include __DIR__ . '/../Views/VistaCatalogo.php';
        $contenido=ob_get_clean();
        
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function verObra($id) {
        if(!$id) {
            http_response_code(400);
            ob_start();
            require_once __DIR__ . '/../Views/400.php';
            $contenido=ob_get_clean();
            require_once __DIR__ . '/../Views/layout.php';
            return;
        }
        
        $obra=Obra::crearInstancia($id);
        
        if(!$obra) {
            http_response_code(404);
            ob_start();
            require_once __DIR__ . '/../Views/404.php';
            $contenido=ob_get_clean();
            require_once __DIR__ . '/../Views/layout.php';
            return;
        }

        if($obra->getFechaBorrado()){
            http_response_code(404);
            ob_start();
            require_once __DIR__ . '/../Views/404.php';
            $contenido=ob_get_clean();
            require_once __DIR__ . '/../Views/layout.php';
            return;
        }

        $portada=$obra->getPortada();
        $autores=$obra->obtenerAutores();
        $etiquetas=$obra->obtenerEtiquetas();
        $comentarios=(new ComentarioController())->obtenerComentariosPorObra($obra->getId());
        $totalPuntuaciones=$obra->obtenerPuntuaciones();
        $puntuacionMedia=$obra->obtenerPuntuacionMedia();
        $puntuacionUsuario=null;

        $title=$obra->getTitulo();
        
        if(isset($_SESSION['id_usuario'])) {
            $instancia=Puntuacion::buscarPorUsuarioYObra($_SESSION['id_usuario'], $obra->getId());
            $puntuacionUsuario=$instancia ? $instancia->getValor() : 0;
        }
        
        ob_start();
        include __DIR__ . '/../Views/VistaObra.php';
        $contenido=ob_get_clean();
        
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function cargarTodas(){
        return Obra::cargarTodas();
    }

    public function novedades(){
        return Obra::obtenerNovedades();
    }

    public function crearObra(){
        $titulo=trim($_POST['titulo'] ?? '');
        $sinopsis=trim($_POST['sinopsis'] ?? '');
        $paginas=trim($_POST['pagina'] ?? '');
        $anio=trim($_POST['anio'] ?? '');
        $genero=trim($_POST['genero'] ?? '');

        if(empty($titulo) || empty($genero)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Título y género son obligatorios']);
            exit;
        }

        $id=Obra::guardar($titulo, $sinopsis, $paginas, $anio, $genero);

        if(isset($_POST['autores']) && is_array($_POST['autores'])) {
            $obra=Obra::crearInstancia($id);
            foreach($_POST['autores'] as $idAutor) {
                $obra->addAutor((int)$idAutor);
            }
        }

        if(isset($_POST['etiquetas']) && is_array($_POST['etiquetas'])) {
            $obra=Obra::crearInstancia($id);
            foreach($_POST['etiquetas'] as $idEtiqueta) {
                $obra->addEtiqueta((int)$idEtiqueta);
            }
        }

        $formatos=['pdf'=>'archivo_pdf','epub'=>'archivo_epub'];
        foreach($formatos as $formato=>$nombreInput){
            if(isset($_FILES[$nombreInput]) && $_FILES[$nombreInput]['error']===UPLOAD_ERR_OK){
                $nombreArchivo=str_replace(' ','_',$titulo).".".$formato;
                $rutaDestino='/obras/recursos'.strtoupper($formato).'/'.$nombreArchivo;

                move_uploaded_file($_FILES[$nombreInput]['tmp_name'], $rutaDestino);
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true, 'id'=>$id]);
    }

    public function editarObra($id){
        $id=(int)($id);
        if(!$id){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'ID de obra requerido']);
            return;
        }

        $obra=Obra::crearInstancia($id);
        if(!$obra){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Obra no encontrada']);
            return;
        }
        
        if(!empty($_POST['titulo'])) $obra->setTitulo($_POST['titulo']);
        if(!empty($_POST['sinopsis'])) $obra->setSinopsis($_POST['sinopsis']);
        if(!empty($_POST['pagina'])) $obra->setPaginas($_POST['pagina']);
        if(!empty($_POST['anio'])) $obra->setAnioPublicacion($_POST['anio']);
        if(!empty($_POST['genero'])) $obra->setGenero($_POST['genero']);

        $autoresActualizar=json_decode($_POST['autores_actualizar'] ?? '[]', true);
        if(is_array($autoresActualizar) && count($autoresActualizar) > 0){
            $obra->eliminarAutores();
            foreach($autoresActualizar as $autor){
                $obra->addAutor($autor);
            }
        }

        $etiquetasActualizar=json_decode($_POST['etiquetas_actualizar'] ?? '[]', true);
        if(is_array($etiquetasActualizar) && count($etiquetasActualizar) > 0){
            $obra->eliminarEtiquetas();
            foreach($etiquetasActualizar as $etiqueta){
                $obra->addEtiqueta($etiqueta);
            }
        }
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function eliminarObra(){
        $id=(int)($_POST['idObra']);
        if(!$id){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'ID de obra requerido']);
            return;
        }

        $obra=Obra::crearInstancia($id);
        if(!$obra){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Obra no encontrada']);
            return;
        }
        
        $obra->eliminar();
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function activarObra($id){
        if($id!=$_POST['idObra']){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Error al activar la obra']);
            return;
        }
        $obra=Obra::crearInstancia($id);
        if(!$obra){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Obra no encontrada']);
            return;
        }
        
        $obra->setFechaBorrado(null);
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function agregarComentario($id_obra, $id_usuario) {
        $contenido=$_POST['contenido'];
        $idComentario=Comentario::guardar($contenido, $id_usuario, $id_obra);
        $comentario=Comentario::crearInstancia($idComentario);
        echo json_encode(['comentario' => $comentario]);
    }

    public function agregarPuntuacion($id_obra, $id_usuario) {
        $puntuacion=$_POST['puntuacion'];
        $idPuntuacion=Puntuacion::guardar($puntuacion, $id_usuario, $id_obra);
        $puntuacion=Puntuacion::crearInstancia($idPuntuacion);
        echo json_encode(['puntuacion' => $puntuacion]);
    }

    public function descargar($id_obra, $formato) {
        if (!is_numeric($id_obra)) {
            http_response_code(400);
            echo "ID inválido";
            return;
        }
        
        $formatosPermitidos = ['pdf', 'epub'];
        if (!in_array(strtolower($formato), $formatosPermitidos)) {
            http_response_code(400);
            echo "Formato no válido";
            return;
        }
        
        $obra = Obra::crearInstancia($id_obra);
        
        if (!$obra) {
            http_response_code(404);
            echo "Obra no encontrada";
            return;
        }
        
        $rutaArchivo = null;
        if ($formato === 'pdf') {
            $rutaArchivo = $obra->getRutaPdf();
        } elseif ($formato === 'epub') {
            $rutaArchivo = $obra->getRutaEpub();
        }
        
        if (!$rutaArchivo) {
            http_response_code(404);
            echo "Formato no disponible";
            return;
        }
        
        $rutaCompleta = ROOT_PATH . 'public/' . $rutaArchivo;
        if (!file_exists($rutaCompleta)) {
            http_response_code(404);
            echo "Archivo no encontrado";
            return;
        }
        
        $titulo = $obra->getTitulo();
        $nombreArchivo = preg_replace('/[^a-zA-Z0-9_-]/', '_', $titulo);
        $nombreArchivo .= '.' . $formato;
        
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . $nombreArchivo . '"');
        header('Content-Length: ' . filesize($rutaCompleta));
        header('Cache-Control: no-cache, must-revalidate');
        header('Pragma: public');
        
        if (ob_get_level()) {
            ob_clean();
            flush();
        }
        
        readfile($rutaCompleta);
        exit;
    }

    public function cargarTodasParaAdmin(){
        return Obra::cargarTodasParaAdmin();
    }
}
