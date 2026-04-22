<?php
require_once __DIR__ . '/UsuarioController.php';
require_once __DIR__ . '/AutorController.php';
require_once __DIR__ . '/ComentarioController.php';
require_once __DIR__ . '/ObraController.php';
require_once __DIR__ . '/EtiquetaController.php';

class AdminController {
    public function verPanel() {
        $comentariosReportados=(new ComentarioController())->obtenerComentariosReportados();
        $comentariosUsuariosSinModerar=(new ComentarioController())->obtenerComentariosSinModerar();
        $usuarios=(new UsuarioController())->cargarTodos();
        $obras=(new ObraController())->cargarTodas();
        $autores=(new AutorController())->cargarTodos();
        $etiquetas=(new EtiquetaController())->obtenerTodas();
        $title="Panel de Administración";
        
        ob_start();
        include __DIR__ . '/../Views/admin/VistaAdmin.php';
        $contenido = ob_get_clean();
        
        require_once __DIR__ . '/../Views/layout.php';
    }

    public function crearObra(){
        $controlador=new ObraController();
        $controlador->crearObra();
    }

    public function editarObra(){
        $controlador=new ObraController();
        $controlador->editarObra();
    }

    public function eliminarObra(){
        $controlador=new ObraController();
        $controlador->eliminarObra();
    }

    public function crearAutor(){
        $controlador=new AutorController();
        $controlador->crearAutor();
    }

    public function editarAutor(){
        $controlador=new AutorController();
        $controlador->editarAutor();
    }

    public function eliminarAutor(){
        $controlador=new AutorController();
        $controlador->eliminarAutor();
    }

    public function banearUsuario(){
        $controlador=new UsuarioController();
        $controlador->banearUsuario();
    }

    public function activarUsuario(){
        $controlador=new UsuarioController();
        $controlador->activarUsuario();
    }

    public function editarUsuario(){
        $controlador=new UsuarioController();
        $controlador->editarUsuario();
    }

    public function revisarComentario(){
        $controlador=new ComentarioController();
        $controlador->revisarComentario();
    }

    public function eliminarComentario(){
        $controlador=new ComentarioController();
        $controlador->eliminarComentario();
    }
}
