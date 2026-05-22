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
        $datosActualizados['pass'] ? $usuario->setPass($datosActualizados['pass']) : null;
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
        header('Content-Type: application/json');

        if(!isset($_SESSION['id_usuario'])){
            http_response_code(401);
            echo json_encode(['error' => 'No autenticado']);
            return;
        }
        
        $datos=Usuario::buscarPorId($_SESSION['id_usuario']);
        if(!$datos){
            http_response_code(404);
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }

        $usuario=Usuario::crearInstanciaId($_SESSION['id_usuario']);
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

        $nombreCambiado = ($nombre !== '' && $nombre !== $usuario->getNombre());
        $nombreUsuarioCambiado = ($nombreUsuario !== '' && $nombreUsuario !== $usuario->getNombreUsuario());
        $correoCambiado = ($correo !== '' && $correo !== $usuario->getCorreo());
        $bioCambiada = ($bio !== '' && $bio !== ($usuario->getBio() ?? ''));
        $fotoCambiada = ($rutaFoto !== '' && $rutaFoto !== $usuario->getRutaFoto());
        $passCambiada = ($passNueva !== '');

        if(($correoCambiado || $passCambiada) && $passConfirmacion === ''){
            http_response_code(400);
            echo json_encode(['error'=>'Debes confirmar tu contraseña actual para cambios de seguridad']);
            return;
        }
        
        if(($correoCambiado || $passCambiada) && !password_verify($passConfirmacion, $usuario->getPass())){
            http_response_code(403);
            echo json_encode(['error'=>'Contraseña actual incorrecta']);
            return;
        }

        if($nombreCambiado){
            $usuario->setNombre($nombre);
        }

        if($nombreUsuarioCambiado){
            $patronUsuario='/^[a-zA-Z0-9_]{3,30}$/';

            if(!preg_match($patronUsuario, $nombreUsuario)){
                http_response_code(400);
                echo json_encode(['error'=>'El nombre de usuario puede contener sólo letras, números y guiones bajos, entre 3 y 30 caracteres']);
                return;
            }

            $existe=Usuario::buscarPorUsuario($nombreUsuario);

            if($existe && (int)$existe['id'] !== (int)$usuario->getId()){
                http_response_code(400);
                echo json_encode(['error'=>'El nombre de usuario ya está registrado']);
                return;
            }

            $usuario->setNombreUsuario($nombreUsuario);
            $_SESSION['nombre_usuario']=$nombreUsuario;
        }

        if($correoCambiado){
            if(!filter_var($correo, FILTER_VALIDATE_EMAIL)){
                http_response_code(400);
                echo json_encode(['error'=>'El formato de correo no es válido']);
                return;
            }

            $existe=Usuario::buscarPorCorreo($correo);

            if($existe && (int)$existe['id'] !== (int)$usuario->getId()){
                http_response_code(400);
                echo json_encode(['error'=>'El correo ya está registrado']);
                return;
            }

            $usuario->setCorreo($correo);
        }

        if($bioCambiada){
            $usuario->setBio($bio);
        }

        if($fotoCambiada){
            $usuario->setRutaFoto($rutaFoto);
        }

        if($passCambiada){
            if($passRepite === ''){
                http_response_code(400);
                echo json_encode(['error'=>'Debes repetir la nueva contraseña']);
                return;
            }

            if($passNueva !== $passRepite){
                http_response_code(400);
                echo json_encode(['error'=>'Las contraseñas nuevas no coinciden']);
                return;
            }

            if(strlen($passNueva) < 8){
                http_response_code(400);
                echo json_encode(['error'=>'La contraseña debe tener al menos 8 caracteres']);
                return;
            }

            $patronPass='/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';

            if(!preg_match($patronPass, $passNueva)){
                http_response_code(400);
                echo json_encode(['error'=>'La contraseña debe contener mayúscula, minúscula, número y símbolo']);
                return;
            }

            $usuario->setPass($passNueva);
        }

        echo json_encode(['ok'=>true]);
    }

    public function subirFoto($id){
        $id=(int)$id;

        if(!isset($_SESSION['id_usuario']) || $id !== (int)$_SESSION['id_usuario']){
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'No puedes modificar la foto de otro usuario']);
            return;
        }

        if(!isset($_FILES['avatar']) || $_FILES['avatar']['error'] !== UPLOAD_ERR_OK){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Error al subir la foto']);
            return;
        }

        if($_FILES['avatar']['size'] > 2 * 1024 * 1024){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'La imagen no puede superar 2MB']);
            return;
        }

        $ext=strtolower(pathinfo($_FILES['avatar']['name'], PATHINFO_EXTENSION));
        $extensionesPermitidas=['jpg','jpeg','png','webp'];

        if(!in_array($ext,$extensionesPermitidas,true)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Formato de imagen no permitido']);
            return;
        }

        $finfo=new finfo(FILEINFO_MIME_TYPE);
        $mime=$finfo->file($_FILES['avatar']['tmp_name']);
        $mimesPermitidos=['image/jpeg','image/png','image/webp'];

        if(!in_array($mime,$mimesPermitidos,true)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Tipo de archivo no válido']);
            return;
        }

        $datos=Usuario::buscarPorId($id);
        if(!$datos){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Usuario no encontrado']);
            return;
        }

        $dir=__DIR__ . '/../../public/assets/img/imgperfil/';
        if(!is_dir($dir)) mkdir($dir,0755,true);

        $nombre='usuario_'.$id.'_'.bin2hex(random_bytes(8)).'.'.$ext;

        if(!move_uploaded_file($_FILES['avatar']['tmp_name'], $dir.$nombre)){
            http_response_code(500);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'No se pudo guardar la imagen']);
            return;
        }

        $ruta='assets/img/imgperfil/'.$nombre;
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
        
        $nombre=trim($_POST['edNombre'] ?? '');
        $nombre_usuario=trim($_POST['edNombreUsuario'] ?? '');
        $correo=trim($_POST['edCorreo'] ?? '');
        $bio=trim($_POST['edBio'] ?? '');
        $ruta_foto=trim($_POST['edRutaFoto'] ?? '');
        $pass=trim($_POST['edPass'] ?? '');
        
        if(!empty($correo) && !filter_var($correo, FILTER_VALIDATE_EMAIL)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El correo no es válido']);
            return;
        }

        if(!empty($nombre_usuario) && $nombre_usuario !== $usuario->getNombreUsuario()){
            $existente = Usuario::buscarPorUsuario($nombre_usuario);
            if($existente){
                http_response_code(409);
                header('Content-Type: application/json');
                echo json_encode(['error'=>'Ese nombre de usuario ya está en uso']);
                return;
            }
        }

        if(!empty($correo) && $correo !== $usuario->getCorreo()){
            $existente = Usuario::buscarPorCorreo($correo);
            if($existente){
                http_response_code(409);
                header('Content-Type: application/json');
                echo json_encode(['error'=>'Ese correo ya está en uso']);
                return;
            }
        }

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
        if(!$usuario) return;
        
        $usuario->fiable();
        
        return true;
    }
}
?>
