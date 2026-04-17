<?php
require_once __DIR__ . '/../Models/Lista.php';
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Usuario.php';

class ListaController {
    public function verLista($id) {
        $lista = Lista::crearInstancia($id);
        if (!$lista) {
            http_response_code(404);
            require_once __DIR__ . '/../Views/404.php';
            return;
        }
        
        $obras = $lista->obtenerObrasConDetalles();
        $totalObras = count($obras);

        $idCreador=$lista->getIdUsuario();
        $instanciaCreador=Usuario::crearInstanciaId($idCreador);

        $meGusta=false;
        if(isset($_SESSION['id_usuario'])){
            $likes=$lista->obtenerMeGusta();
            $meGusta=in_array($_SESSION['id_usuario'], array_column($likes, 'id_usuario'));
        }

        $esPropietario=false;
        $estaCopiada=false;
        if(isset($_SESSION['id_usuario'])){
            if($_SESSION['id_usuario'] == $idCreador){
                $esPropietario=true;
            }
            else{
                $estaCopiada=$lista->comprobarCopia($_SESSION['id_usuario']);
            }
        }

        $title=$lista->getNombre();

        ob_start();
        include __DIR__ . '/../Views/VistaLista.php';
        $contenido = ob_get_clean();
        
        require_once __DIR__ . '/../Views/layout.php';
    }
}
