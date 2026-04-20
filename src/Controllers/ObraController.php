<?php
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Models/Comentario.php';
require_once __DIR__ . '/../Models/Puntuacion.php';
require_once __DIR__ . '/../Models/Etiqueta.php';
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/ComentarioController.php';

class ObraController {
    public function verObra($id) {
        if(!$id) {
            http_response_code(400);
            echo json_encode(['error' => 'ID de obra requerido']);
            return;
        }
        
        $obra=Obra::crearInstancia($id);
        
        if(!$obra) {
            http_response_code(404);
            echo json_encode(['error' => 'Obra no encontrada']);
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
            $puntuacionUsuario=Puntuacion::buscarPorUsuarioYObra($_SESSION['id_usuario'], $obra->getId());
        }
        
        ob_start();
        include __DIR__ . '/../Views/VistaObra.php';
        $contenido=ob_get_clean();
        
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function cargarTodas(){
        return Obra::cargarTodas();
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
        
        header('Content-Type: app/json');
        echo json_encode(['ok'=>true, 'id'=>$id]);
    }

    public function editarObra(){
        $id=(int)($_POST['id_obra'] ?? 0);
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
        if(!empty($_POST['pagina'])) $obra->setPagina($_POST['pagina']);
        if(!empty($_POST['anio'])) $obra->setAnio($_POST['anio']);
        if(!empty($_POST['genero'])) $obra->setGenero($_POST['genero']);

        if(!empty($_POST['autores_actualizar']) && is_array($_POST['autores_actualizar'])) {
            foreach($_POST['autores_actualizar'] as $idAutor) {
                $obra->addAutor((int)$idAutor);
            }
        }

        if(!empty($_POST['etiquetas_actualizar']) && is_array($_POST['etiquetas_actualizar'])) {
            foreach($_POST['etiquetas_actualizar'] as $idEtiqueta) {
                $obra->addEtiqueta((int)$idEtiqueta);
            }
        }
        
        header('Content-Type: app/json');
        echo json_encode(['ok'=>true]);
    }

    public function eliminarObra(){
        $id=(int)($_POST['id_obra'] ?? 0);
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
        header('Content-Type: app/json');
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
}
