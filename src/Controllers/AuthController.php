<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/UsuarioController.php';
require_once __DIR__ . '/../../config/Database.php';
require_once __DIR__ . '/../../core/Router.php';

class AuthController {
    public function login(){
        $pass=trim($_POST['pass'] ?? '');
        $identificador=trim($_POST['identificador'] ?? '');

        if(strpos($identificador, '@') !== false){
            $email=$identificador;
            $nombreUsuario=null;
        }else{
            $nombreUsuario=$identificador;
            $email=null;
        }
         
        if(empty($identificador) || empty($pass)){            
            $_SESSION['error_login']='Todos los campos son obligatorios';
            Router::redirect('/');
            return;
        }
        
        if(!empty($email)){
            $controlador=new UsuarioController();
            $datos=$controlador->buscarPorCorreo($email);
        }
        elseif(!empty($nombreUsuario)){
            $controlador=new UsuarioController();
            $datos=$controlador->buscarPorUsername($nombreUsuario);
        }
        
        if(!$datos || !password_verify($pass, $datos['pass'])){
            $_SESSION['error_login']='Email o contraseña incorrectos';
            Router::redirect('/');
            return;
        }

        if($datos['activo'] == 0){
            $_SESSION['error_login']='Tu cuenta ha sido desactivada';
            Router::redirect('/');
            return;
        }
        
        $_SESSION['id_usuario']=$datos['id'];
        $_SESSION['nombre_usuario']=$datos['nombre'];
        $_SESSION['es_admin']=(bool)$datos['es_admin'];

        session_regenerate_id(true);
        
        if($_SESSION['es_admin']) {
            Router::redirect('/admin');
        }
        Router::redirect('/usuario/' . $datos['id']);
    }
    
    public function logout(){
        $_SESSION=[];
        if(ini_get("session.use_cookies")){
            $params=session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params["path"], $params["domain"],
                $params["secure"], $params["httponly"]
            );
        }

        session_destroy();
        Router::redirect('/');
    }

    public function registro(){
        $nombre=trim($_POST['nombre'] ?? '');
        $nombreUsuario=trim($_POST['nombre_usuario'] ?? '');
        $email=trim($_POST['correo'] ?? '');
        $pass=trim($_POST['pass'] ?? '');
        $passConfirmacion=trim($_POST['pass_confirmacion'] ?? '');
        
        if(empty($nombre) || empty($nombreUsuario) || empty($email) || empty($pass) || empty($passConfirmacion)){
            $_SESSION['error_registro']='Todos los campos son obligatorios';
            Router::redirect('/');
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $_SESSION['error_registro']='El formato de correo no es válido';
            Router::redirect('/');
            return;
        }

        if(strlen($pass) < 8){
            $_SESSION['error_registro']='La contraseña debe tener al menos 8 caracteres';
            Router::redirect('/');
            return;
        }
        if($pass !== $passConfirmacion){
            $_SESSION['error_registro']='Las contraseñas no coinciden';
            Router::redirect('/');
            return;
        }
        $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        if (!preg_match($patron, $pass)) {
            $_SESSION['error_registro'] = 'La contraseña debe contener mayúscula, minúscula, número y símbolo';
            Router::redirect('/');
            return;
        }
        
        $patron2='/^[a-zA-Z0-9_]{3,30}$/';
        if(!preg_match($patron2, $nombreUsuario)){
            $_SESSION['error_registro'] = 'El nombre de usuario puede contener sólo letras, números y guiones bajos, entre 3 y 30 caracteres';
            Router::redirect('/');
            return;
        }

        $controladorUsuario=new UsuarioController();
        if($controladorUsuario->buscarPorUsuario($nombreUsuario)){
            $_SESSION['error_registro']='El nombre de usuario ya está registrado';
            Router::redirect('/');
            return;
        }
        if($controladorUsuario->buscarPorCorreo($email)){
            $_SESSION['error_registro']='El correo ya está registrado';
            Router::redirect('/');
            return;
        }

        $id=$controladorUsuario->guardarUsuario($nombre,$nombreUsuario,$email,$pass);
        
        $_SESSION['id_usuario']=$id;
        $_SESSION['nombre_usuario']=$nombreUsuario;
        $_SESSION['es_admin']=0;

        session_regenerate_id(true);

        Router::redirect('/usuario/'.$id);
    }
}
