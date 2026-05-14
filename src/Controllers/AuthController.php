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
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Todos los campos son obligatorios']);
            return;
        }
        
        if(!empty($email)){
            $controlador=new UsuarioController();
            $datos=$controlador->buscarPorCorreo($email);
        }
        elseif(!empty($nombreUsuario)){
            $controlador=new UsuarioController();
            $datos=$controlador->buscarPorUsuario($nombreUsuario);
        }
        
        if(!$datos || !password_verify($pass, $datos['pass'])){
            http_response_code(401);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Email o contraseña incorrectos']);
            return;
        }

        if($datos['activo'] == 0){
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Tu cuenta ha sido desactivada']);
            return;
        }
        
        $_SESSION['id_usuario']=$datos['id'];
        $_SESSION['nombre_usuario']=$datos['nombre_usuario'];
        $_SESSION['es_admin']=(bool)$datos['es_admin'];

        session_regenerate_id(true);
        
        header('Content-Type: application/json');
        echo json_encode([
            'ok'=>true,
            'redirect'=>$_SESSION['es_admin'] ? '/admin' : '/'
        ]);
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
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Todos los campos son obligatorios']);
            return;
        }

        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El formato de correo no es válido']);
            return;
        }

        if(strlen($pass) < 8){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'La contraseña debe tener al menos 8 caracteres']);
            return;
        }
        if($pass !== $passConfirmacion){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Las contraseñas no coinciden']);
            return;
        }
        $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        if(!preg_match($patron, $pass)) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'La contraseña debe contener mayúscula, minúscula, número y símbolo']);
            return;
        }
        
        $patron2='/^[a-zA-Z0-9_]{3,30}$/';
        if(!preg_match($patron2, $nombreUsuario)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El nombre de usuario puede contener sólo letras, números y guiones bajos, entre 3 y 30 caracteres']);
            return;
        }

        $controladorUsuario=new UsuarioController();
        if($controladorUsuario->buscarPorUsuario($nombreUsuario)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El nombre de usuario ya está registrado']);
            return;
        }
        if($controladorUsuario->buscarPorCorreo($email)){
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'El correo ya está registrado']);
            return;
        }

        $id=$controladorUsuario->guardarUsuario($nombre,$nombreUsuario,$email,$pass);
        
        $_SESSION['id_usuario']=$id;
        $_SESSION['nombre_usuario']=$nombreUsuario;
        $_SESSION['es_admin']=0;

        session_regenerate_id(true);

        header('Content-Type: application/json');
        echo json_encode([
            'ok'=>true,
            'redirect'=>'/usuario/'.$id
        ]);
    }
}
