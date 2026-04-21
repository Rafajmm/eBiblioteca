<?php
require_once __DIR__ . '/ObraController.php';
require_once __DIR__ . '/AutorController.php';
require_once __DIR__ . '/ListaController.php';

class BibliotecaController {
    public function catalogo() {
        $obraController=new ObraController();
        $obraController->catalogo();
    }

    public function autores(){
        $autorController=new AutorController();
        $autorController->autores();
    }

    public function colecciones(){
        $listaController=new ListaController();
        $listaController->colecciones();
    }

    public function index(){
        $totalObras=count((new ObraController())->cargarTodas());
        $totalAutores=count((new AutorController())->cargarTodos());
        $totalColecciones=(new ListaController())->totalColecciones();
        $novedades=(new ObraController())->novedades();
        
        $title="Inicio";
        
        ob_start();
        include __DIR__ . '/../Views/index.php';
        $contenido=ob_get_clean();
        
        require_once __DIR__ . '/../Views/layout.php';
    }    
}
?>
