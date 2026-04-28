<?php
require_once __DIR__ . '/../Models/Puntuacion.php';
require_once __DIR__ . '/../Models/Obra.php';

class PuntuacionController {
    public function puntuar(){
        $valor=(int)($_POST['valor'] ?? 0);
        $idObra=(int)($_POST['idObra'] ?? 0);
        
        if($valor<1 || $valor>5){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'La puntuación debe ser entre 1 y 5']);
            return;
        }
        
        if(!$idObra){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'ID de obra requerido']);
            return;
        }
        
        $obra=Obra::crearInstancia($idObra);
        if(!$obra){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Obra no encontrada']);
            return;
        }

        $existente=Puntuacion::buscarPorUsuarioYObra($_SESSION['id_usuario'], $idObra);
        if($existente){
            $existente->sobreescribir($valor);
        } else {
            Puntuacion::guardar($valor, $_SESSION['id_usuario'], $idObra);
        }

        $nuevaMedia=$obra->obtenerPuntuacionMedia();
        $totalPuntuaciones=$obra->obtenerPuntuaciones();
        
        header('Content-Type: application/json');
        echo json_encode([
            'ok'=>true,
            'nuevaMedia'=>$nuevaMedia,
            'totalPuntuaciones'=>$totalPuntuaciones
        ]);
    }
}
