<?php
require_once __DIR__ . '/../Models/Comentario.php';
require_once __DIR__ . '/UsuarioController.php';

class ComentarioController {
    public function obtenerComentariosPorObra($id_obra){
        $comentarios=Comentario::obtenerPorObra($id_obra);
        return $comentarios;
    }
    public function obtenerComentariosReportados(){
        $comentarios=Comentario::obtenerReportados();
        return $comentarios;
    }    
    public function obtenerComentariosSinModerar(){
        $comentarios=Comentario::obtenerComentariosSinModerar();
        return $comentarios;
    }

    public function revisarComentario($id){
        $id=(int)($_POST['idComentario']);
        $comentario=Comentario::crearInstancia($id);
        if(!$comentario){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Comentario no encontrado']);
            return;
        }
        
        $comentario->revisar();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function eliminarComentario($id){
        $id=(int)($_POST['idComentario']);
        $comentario=Comentario::crearInstancia($id);
        if(!$comentario){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Comentario no encontrado']);
            return;
        }
        
        $comentario->eliminarReporte();
        $comentario->eliminar();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function crear(){
        $contenido=trim($_POST['contenido']) ?? '';
        $idObra=(int)($_POST['idObra']) ?? 0;
        
        if(empty($contenido)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El comentario no puede estar vacio']);
            return;
        }

        if(!$idObra){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'ID de obra requerido']);
            return;
        }
        
        if(strlen($contenido) > 2000){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El comentario no puede tener mas de 2000 caracteres']);
            return;
        }
        
        $id=Comentario::guardar($contenido,$_SESSION['id_usuario'],$idObra);
        $comentario=Comentario::crearInstancia($id);

        header('Content-Type: application/json');
        echo json_encode([
            'ok'=>true,
            'id'=>$id,
            'contenido'=>$contenido,
            'fecha'=>$comentario->getFechaComentario(),
            'nombreUsuario'=>$_SESSION['nombre_usuario']
         ]);
    }

    public function reportar($id){
        $comentario=Comentario::crearInstancia($id);
        if(!$comentario){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Comentario no encontrado']);
            return;
        }
        
        $comentario->reportar($_SESSION['id_usuario']);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function meGusta($id){
        $comentario=Comentario::crearInstancia($id);
        if(!$comentario){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Comentario no encontrado']);
            return;
        }
        
        $comentario->meGusta($_SESSION['id_usuario']);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function quitarMeGusta($id){
        $comentario=Comentario::crearInstancia($id);
        if(!$comentario){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Comentario no encontrado']);
            return;
        }
        
        $comentario->eliminarMeGusta($_SESSION['id_usuario']);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function aprobarComentario($id){
        $comentario=Comentario::crearInstancia($id);
        if(!$comentario){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Comentario no encontrado']);
            return;
        }

        $controlador=new UsuarioController();
        $controlador->fiableUsuario($comentario->getIdUsuario());
        
        $comentario->revisar();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }
}
