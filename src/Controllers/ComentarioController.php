<?php
require_once __DIR__ . '/../Models/Comentario.php';

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
}