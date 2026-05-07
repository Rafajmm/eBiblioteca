<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Lista.php';
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/ListaController.php';


class UsuarioController {
    public function verPerfil($id_usuario) {
        $id_sesion=$_SESSION['id_usuario'] ?? null;
        $esPerfilUsuario=($id_sesion!==null && $id_sesion==$id_usuario);
        
        $usuario=Usuario::crearInstanciaId($id_usuario);

        if(!$usuario) {
            http_response_code(404);
            ob_start();
            require_once __DIR__ . '/../Views/404.php';
            $contenido=ob_get_clean();
            require_once __DIR__ . '/../Views/layout.php';
            return;
        }

        if(!$usuario->getActivo()){
            http_response_code(404);
            require_once __DIR__ . '/../Views/404.php';
            return;
        }

        if($esPerfilUsuario){
            $tablon=$usuario->obtenerTablon();
        }
        else{
            $tablon=$usuario->obtenerActividad();
        }
        
        $seguidores=$usuario->obtenerSeguidores();
        $seguidos=$usuario->obtenerSeguidos();
        
        $listas=$usuario->cargarListas();
        $listasSeguidas=[];
        if($esPerfilUsuario && isset($_SESSION['id_usuario'])) {
            $listasSeguidas=$usuario->cargarListasSeguidas();
        }
        
        $title=htmlspecialchars($usuario->getNombreUsuario());

        

        $esSeguido=false;
        if($id_sesion && !$esPerfilUsuario){
            $datosActor=Usuario::buscarPorId($id_sesion);
            $actor=Usuario::crearInstancia($datosActor['nombre_usuario']);
            $esSeguido=$actor->esSeguido($id_usuario);
        }

        ob_start();
        require_once __DIR__ . '/../Views/VistaUsuario.php';
        $contenido=ob_get_clean();

        require_once __DIR__ . '/../Views/layout.php';
    }

    public function actualizar($id_usuario) {
        $datos=Usuario::buscarPorId($id_usuario);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);

        if(!$usuario) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
            return;
        }

        $datosActualizados=json_decode(file_get_contents('php://input'), true);

        $datosActualizados['nombre'] ? $usuario->setNombre($datosActualizados['nombre']) : null;
        $datosActualizados['nombre_usuario'] ? $usuario->setNombreUsuario($datosActualizados['nombre_usuario']) : null;
        $datosActualizados['correo'] ? $usuario->setCorreo($datosActualizados['correo']) : null;
        $datosActualizados['pass'] ? $usuario->setPass(password_hash($datosActualizados['pass'], PASSWORD_BCRYPT)) : null;
        $datosActualizados['bio'] ? $usuario->setBio($datosActualizados['bio']) : null;
        $datosActualizados['ruta_foto'] ? $usuario->setRutaFoto($datosActualizados['ruta_foto']) : null;

        $usuario->actualizar();
    }

    public function eliminar($id_usuario) {
        $datos=Usuario::buscarPorId($id_usuario);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);

        if(!$usuario) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
            return;
        }

        $usuario->eliminar();
    }

    public function editarPerfil(){
        if(!isset($_SESSION['id_usuario'])){
            http_response_code(401);
            echo json_encode(['error' => 'No autenticado']);
            return;
        }
        
        $datos=Usuario::buscarPorId($_SESSION['id_usuario']);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);
        if(!$usuario){
            http_response_code(404);
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }

        $nombre=trim($_POST['nombre'] ?? '');
        $nombreUsuario=trim($_POST['nombre_usuario'] ?? '');
        $correo=trim($_POST['correo'] ?? '');
        $bio=trim($_POST['bio'] ?? '');
        $rutaFoto=trim($_POST['ruta_foto'] ?? '');
        $passNueva=trim($_POST['pass_nueva'] ?? '');
        $passRepite=trim($_POST['pass_repite'] ?? '');
        $passConfirmacion=trim($_POST['pass_confirmacion'] ?? '');

        $correoCambiado = (!empty($correo) && $correo !== $usuario->getCorreo());
        $passCambiado = (!empty($passNueva));
        
        if(($correoCambiado || $passCambiado) && empty($passConfirmacion)){
            http_response_code(400);
            echo json_encode(['error'=>'Debes confirmar tu contraseña actual para cambios de seguridad']);
            return;
        }
        
        if(($correoCambiado || $passCambiado) && !password_verify($passConfirmacion, $usuario->getPass())){
            http_response_code(403);
            echo json_encode(['error'=>'Contraseña actual incorrecta']);
            return;
        }
        
        if(!empty($nombre)) $usuario->setNombre($nombre);

        if(!empty($nombreUsuario)){
            $existe=Usuario::buscarPorUsuario($nombreUsuario);
            if($existe){
                http_response_code(400);
                echo json_encode(['error'=>'Nombre de usuario ya existe']);
                return;
            }
            $usuario->setNombreUsuario($nombreUsuario);
            $_SESSION['nombre_usuario'] = $nombreUsuario;
        }

        if(!empty($correo)){
            $existe=Usuario::buscarPorCorreo($correo);
            if($existe){
                http_response_code(400);
                echo json_encode(['error'=>'Correo ya existe']);
                return;
            }
            $usuario->setCorreo($correo);            
        }

        if(!empty($bio)) $usuario->setBio($bio);
        if(!empty($rutaFoto)) $usuario->setRutaFoto($rutaFoto);
        if(!empty($passNueva) && !empty($passRepite) && $passNueva === $passRepite) $usuario->setPass(password_hash($passNueva, PASSWORD_BCRYPT));

        $usuario->actualizar();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function subirFoto($id){
        if(!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK){
            http_response_code(400);
            echo json_encode(['error' => 'Error al subir la foto']);
            return;
        }
        
        $dir=__DIR__ . '/../../public/assets/img/imgperfil/';
        if(!is_dir($dir)) mkdir($dir,0755,true);
        
        $ext=pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION);
        $nombre='usuario_'.$id.'_'.time().'.'.$ext;
        move_uploaded_file($_FILES['avatar']['tmp_name'], $dir.$nombre);

        $ruta='assets/img/imgperfil/'.$nombre;
        $datos=Usuario::buscarPorId($id);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);
        $usuario->setRutaFoto($ruta);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true, 'ruta'=>$ruta]);
    }

    public function seguir($id){
        if(!isset($_SESSION['id_usuario'])){
            http_response_code(401);
            echo json_encode(['error' => 'No autenticado']);
            return;
        }

        if($_SESSION['id_usuario']== $id){
            http_response_code(400);
            echo json_encode(['error' => 'No puedes seguirte a ti mismo']);
            return;
        }
        
        $datos=Usuario::buscarPorId($_SESSION['id_usuario']);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);
        if(!$usuario){
            http_response_code(404);
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }
        
        $resultado=$usuario->seguir($id);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>$resultado]);
    }

    public function dejarSeguir($id){
        if(!isset($_SESSION['id_usuario'])){
            http_response_code(401);
            echo json_encode(['error' => 'No autenticado']);
            return;
        }
        
        $datos=Usuario::buscarPorId($_SESSION['id_usuario']);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);
        if(!$usuario){
            http_response_code(404);
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }
        
        $resultado=$usuario->dejarSeguir($id);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>$resultado]);
    }

    public function eliminarSeguidor($id){
        if(!isset($_SESSION['id_usuario'])){
            http_response_code(401);
            echo json_encode(['error'=>'No autenticado']);
            return;
        }
        $datos=Usuario::buscarPorId($_SESSION['id_usuario']);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);
        $usuario->eliminarSeguidor($id); // ya existe en modelo lín 217
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function buscarPorCorreo($correo){
        $usuario=Usuario::buscarPorCorreo($correo);
        if(!$usuario){            
            return null;
        }        
        return $usuario;
    }

    public function buscarPorUsuario($usuario){
        $usuario=Usuario::buscarPorUsuario($usuario);
        if(!$usuario){            
            return null;
        }        
        return $usuario;
    }

    public function guardarUsuario($nombre,$nombre_usuario,$correo,$pass){
        return Usuario::guardar($nombre,$nombre_usuario,$correo,$pass);
    }

    public function cargarTodos(){
        return Usuario::cargarTodos();
    }

    public function banearUsuario($id){
        $id=(int)$id;
        $usuario=Usuario::crearInstanciaId($id);
        if(!$usuario){
            http_response_code(404);
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }
        
        $usuario->banear();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function activarUsuario($id){
        $id=(int)$id;
        $usuario=Usuario::crearInstanciaId($id);
        if(!$usuario){
            http_response_code(404);
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }
        
        $usuario->activar();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function editarUsuario($id){
        $id=(int)$id;
        $usuario=Usuario::crearInstanciaId($id);
        if(!$usuario){
            http_response_code(404);
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }
        
        $nombre=$_POST['edNombre'];
        $nombre_usuario=$_POST['edNombreUsuario'];
        $correo=$_POST['edCorreo'];
        $bio=$_POST['edBio'];
        $ruta_foto=$_POST['edRutaFoto'];
        $pass=$_POST['edPass'];
        
        if(!empty($nombre)) $usuario->setNombre($nombre);
        if(!empty($nombre_usuario)) $usuario->setNombreUsuario($nombre_usuario);
        if(!empty($correo)) $usuario->setCorreo($correo);
        if(!empty($bio)) $usuario->setBio($bio);
        if(!empty($ruta_foto)) $usuario->setRutaFoto($ruta_foto);
        if(!empty($pass)) $usuario->setPass($pass);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }
    
    public function fiableUsuario($id){
        $id=(int)$id;
        $usuario=Usuario::crearInstanciaId($id);
        if(!$usuario){
            http_response_code(404);
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }
        
        $usuario->fiable();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }
}
?>
