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
        $obras=(new ObraController())->cargarTodasParaAdmin();
        $autores=(new AutorController())->cargarTodosParaAdmin();
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

    public function editarObra($id){
        $controlador=new ObraController();
        $controlador->editarObra($id);
    }

    public function eliminarObra($id){
        $controlador=new ObraController();
        $controlador->eliminarObra($id);
    }

    public function activarObra($id){
        $controlador=new ObraController();
        $controlador->activarObra($id);
    }

    public function crearAutor(){
        $controlador=new AutorController();
        $controlador->crearAutor();
    }

    public function editarAutor($id){
        $controlador=new AutorController();
        $controlador->editarAutor($id);
    }

    public function eliminarAutor($id){
        $controlador=new AutorController();
        $controlador->eliminarAutor($id);
    }

    public function activarAutor($id){
        $controlador=new AutorController();
        $controlador->activarAutor($id);
    }

    public function banearUsuario($id){
        $controlador=new UsuarioController();
        $controlador->banearUsuario($id);
    }

    public function activarUsuario($id){
        $controlador=new UsuarioController();
        $controlador->activarUsuario($id);
    }

    public function editarUsuario($id){
        $controlador=new UsuarioController();
        $controlador->editarUsuario($id);
    }

    public function revisarComentario($id){
        $controlador=new ComentarioController();
        $controlador->revisarComentario($id);
    }

    public function eliminarComentario($id){
        $controlador=new ComentarioController();
        $controlador->eliminarComentario($id);
    }

    public function aprobarComentario($id){
        $controlador=new ComentarioController();
        $controlador->aprobarComentario($id);
    }
}
