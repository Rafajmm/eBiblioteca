<?php
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Models/Comentario.php';
require_once __DIR__ . '/../Models/Puntuacion.php';
require_once __DIR__ . '/../Models/Etiqueta.php';
require_once __DIR__ . '/../Models/Lista.php';

class BibliotecaController {
    public function catalogo() {
        $busqueda=$_GET['parametro'] ?? null;
        $genero=$_GET['genero'] ?? null;
        $autor=$_GET['autor'] ?? null;
        $epoca=$_GET['epoca'] ?? null;
        $pagina=(int)$_GET['pagina'] ?? 1;
        $porPagina=(int)$_GET['porPagina'] ?? 15;

        $obras=$busqueda ? Obra::buscarTodo($busqueda) : Obra::cargarTodas();

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
                $anio=(int)substr($obra['anio_publicacion'], 0, 4);
                return ceil($anio / 100) === $epoca;
            });
        }

        $obras=array_values($obras);

        $total=count($obras);
        $totalPaginas=ceil($total / $porPagina);
        $obras=array_slice($obras, ($pagina - 1) * $porPagina, $porPagina);
        
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
            echo json_encode(['error' => 'ID de obra requerido']);
            return;
        }
        
        $obra=Obra::crearInstancia($id);
        
        if(!$obra) {
            http_response_code(404);
            echo json_encode(['error' => 'Obra no encontrada']);
            return;
        }

        $autores=$obra->obtenerAutores();
        $etiquetas=$obra->obtenerEtiquetas();
        $comentarios=$obra->obtenerComentarios();
        $totalPuntuaciones=count($obra->obtenerPuntuaciones());
        $puntuacionMedia=$obra->obtenerPuntuacionMedia();
        $puntuacionUsuario=null;
        
        if(isset($_SESSION['id_usuario'])) {
            $puntuacionUsuario=Puntuacion::buscarPorUsuarioYObra($_SESSION['id_usuario'], $obra->id);
        }
        
        header('Content-Type: application/json');
        echo json_encode([
            'obra' => $obra,
            'autores' => $autores,
            'etiquetas' => $etiquetas,
            'comentarios' => $comentarios,
            'totalPuntuaciones' => $totalPuntuaciones,
            'puntuacionMedia' => $puntuacionMedia,
            'puntuacionUsuario' => $puntuacionUsuario
        ]);
    }

    public function autores(){
        $nombre=$_GET['nombre'] ?? null;
        $pais=$_GET['pais'] ?? null;
        $epoca=$_GET['epoca'] ?? null;
        $letra=$_GET['letra'] ?? null;
        $pagina=(int)$_GET['pagina'] ?? 1;
        $porPagina=(int)$_GET['porPagina'] ?? 15;

        $autores=$nombre ? Autor::busquedaAvanzada($nombre) : Autor::cargarTodos();

        if($pais){
            $autores=array_filter($autores, function($autor) use ($pais) {
                return $autor['pais'] === $pais;
            });
        }
        if($epoca){
            $autores=array_filter($autores, function($autor) use ($epoca) {
                $anio=(int)substr($autor['fecha_nacimiento'], 0, 4);
                return ceil($anio / 100) === $epoca;
            });
        }
        if($letra){
            $autores=array_filter($autores,function($autor) use($letra){
                return strtoupper(substr($autor['nombre'], 0, 1)) === strtoupper($letra);
            });
        }

        $autores=array_values($autores);
        $total=count($autores);
        $totalPaginas=ceil($total / $porPagina);
        $autores=array_slice($autores, ($pagina - 1) * $porPagina, $porPagina);

        header('Content-Type: application/json');
        echo json_encode([
            'autores' => $autores,
            'total' => $total,
            'totalPaginas' => $totalPaginas,
            'pagina' => $pagina,
            'porPagina' => $porPagina
        ]);

    }

    public function colecciones(){
        $colecciones=Lista::obtenerColecciones();
        $obrasPorColeccion=[];
        foreach($colecciones as $coleccion){
            $obrasPorColeccion[$coleccion['id']]=Lista::obtenerObrasPorId($coleccion['id']);
        }
        $total=count($colecciones);
        

        header('Content-Type: application/json');
        echo json_encode([
            'colecciones' => $colecciones,
            'obrasPorColeccion' => $obrasPorColeccion,
            'total' => $total
        ]);
    }

    
}
?>
