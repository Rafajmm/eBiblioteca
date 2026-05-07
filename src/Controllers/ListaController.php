<?php
require_once __DIR__ . '/../Models/Lista.php';
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Usuario.php';

class ListaController {
    public function colecciones(){
        $colecciones=Lista::obtenerColecciones();
        
        $datosColecciones=[];
        if($colecciones){
            foreach($colecciones as $coleccion){
                $lista=Lista::crearInstancia($coleccion['id']);
                $obras=$lista ? $lista->obtenerObrasConDetalles() : [];
                
                $datosColecciones[$coleccion['id']]=[
                    'id'=>$coleccion['id'],
                    'nombre'=>$coleccion['nombre'],
                    'descipcion'=>$coleccion['descripcion'],
                    'total'=>count($obras),
                    'obras'=>array_slice($obras, 0, 3)
                ];
            }
        }

        $total=count($colecciones);
        

        $title="Colecciones";
        
        ob_start();
        include __DIR__ . '/../Views/VistaColecciones.php';
        $contenido=ob_get_clean();

        require_once __DIR__ . '/../Views/layout.php';
    }

    public function totalColecciones(){
        return count(Lista::obtenerColecciones());
    }

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

    public function crear(){
        $nombre=trim($_POST['nombre'] ?? '');
        $descripcion=trim($_POST['descripcion'] ?? '');
        
        if(empty($nombre)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El nombre es requerido']);
            return;
        }
        
        $id=Lista::guardar($nombre, $_SESSION['id_usuario'], $descripcion);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true, 'id'=>$id]);
    }

    public function agregarObra($id){
        $idObra=(int)($_POST['idObra'] ?? 0);
        
        $lista=Lista::crearInstancia($id);
        if(!$lista){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Lista no encontrada']);
            return;
        }
        
        if($lista->getIdUsuario() != $_SESSION['id_usuario']){
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'No puedes modificar esta lista']);
            return;
        }

        $lista->addObra($idObra);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function eliminarObra($id){
        $idObra=(int)($_POST['idObra'] ?? 0);
        
        $lista=Lista::crearInstancia($id);
        if(!$lista){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Lista no encontrada']);
            return;
        }
        
        if($lista->getIdUsuario() != $_SESSION['id_usuario']){
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'No puedes modificar esta lista']);
            return;
        }

        $lista->eliminarObra($idObra);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function seguir($id){
        $lista=Lista::crearInstancia($id);
        if(!$lista){
            http_response_code(404);
            header('Content-Type: application/json');
            ob_start();
            include __DIR__ . '/../Views/404.php';
            $contenido=ob_get_clean();
            require_once __DIR__ . '/../Views/layout.php';
        }

        $lista->meGusta($_SESSION['id_usuario']);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function dejarDeSeguir($id){
        $lista=Lista::crearInstancia($id);
        if(!$lista){
            http_response_code(404);
            header('Content-Type: application/json');
            ob_start();
            include __DIR__ . '/../Views/404.php';
            $contenido=ob_get_clean();
            require_once __DIR__ . '/../Views/layout.php';
        }

        $lista->quitarMeGusta($_SESSION['id_usuario']);

        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function copiar($id){
        $lista=Lista::crearInstancia($id);
        if(!$lista){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Lista no encontrada']);
            return;
        }

        $nuevaLista=$lista->copiarLista($_SESSION['id_usuario']);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true, 'id'=>$nuevaLista->getId()]);
    }

    public function eliminar($id){
        $lista=Lista::crearInstancia($id);
        if(!$lista){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Lista no encontrada']);
            return;
        }

        if($lista->getIdUsuario() != $_SESSION['id_usuario']){
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'No puedes eliminar esta lista']);
            return;
        }

        $lista->eliminar();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function obtenerListasUsuario($id){
        if(!isset($_SESSION['id_usuario'])){
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'No has iniciado sesión']);
            return;
        }

        if((int)$id!==$_SESSION['id_usuario']){
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'No puedes ver las listas de otro usuario']);
            return;
        }
        
        $listas = Lista::buscarPorUsuario($id);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true, 'listas'=>$listas]);
    }

    public function editarLista($id){
        $id=(int)$id;
        $nombre=trim($_POST['nombre'] ?? '');
        $descripcion=trim($_POST['descripcion'] ?? '');
        
        if(empty($nombre)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El nombre no puede estar vacío']);
            return;
        }
        
        $lista=Lista::crearInstancia($id);
        if(!$lista){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Lista no encontrada']);
            return;
        }
        
        if($lista->getIdUsuario() != $_SESSION['id_usuario']){
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'No puedes editar esta lista']);
            return;
        }
        
        $lista->setNombre($nombre);
        $lista->setDescripcion($descripcion);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }
}
