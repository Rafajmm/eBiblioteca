<?php
require_once __DIR__ . '/../Models/Comentario.php';

class ComentarioController {
    public function obtenerComentarios($id_obra){
        $comentarios=Comentario::obtenerPorObra($id_obra);
        return $comentarios;
    }    
}