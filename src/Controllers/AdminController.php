<?php
require_once __DIR__ . '/../Models/Comentario.php';
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Controllers/ComentarioController.php';

class AdminController {
    public function verPanel() {
        $comentariosReportados=(new ComentarioController())->obtenerComentariosReportados();
        $comentariosUsuariosSinModerar=(new ComentarioController())->obtenerComentariosSinModerar();
        $usuarios=Usuario::cargarTodos();
        $obras=Obra::cargarTodas();
        $autores=Autor::cargarTodos();
        $title="Panel de Administración";
        
        ob_start();
        include __DIR__ . '/../Views/admin/VistaAdmin.php';
        $contenido = ob_get_clean();
        
        require_once __DIR__ . '/../Views/layout.php';
    }
}