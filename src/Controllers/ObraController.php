<?php
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Models/Comentario.php';
require_once __DIR__ . '/../Models/Puntuacion.php';
require_once __DIR__ . '/../Models/Etiqueta.php';

class ObraController {
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
