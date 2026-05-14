<?php
Class Middleware {
    public static function autenticado() {
        if(!isset($_SESSION['id_usuario'])){
            $esAjax=!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

            $esFetch=isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'],'application/json') !==false;

            if($esAjax || $esFetch || $_SERVER['REQUEST_METHOD']!=='GET'){
                http_response_code(401);
                header('Content-Type: application/json');
                echo json_encode(['error'=>'Debes iniciar sesión para realizar esa acción']);
            }
            else{
                $_SESSION['error_login']='Debes iniciar sesión para acceder a esta página';
                Router::redirect('/');            
            }
            return false;
        }
        return true;        
    }

    public static function admin(){
        if(!isset($_SESSION['id_usuario'])){
            $_SESSION['error_login']='Debes iniciar sesión';
            Router::redirect('/');
            return false;
        }
        if(!($_SESSION['es_admin'] ?? false)){
            $_SESSION['error_login']='No tienes permisos para acceder a esta sección';
            Router::redirect('/');
            return false;
        }
        return true;
    }

    public static function csrf(){
        if($_SERVER['REQUEST_METHOD']==='GET'){
            return true;
        }
        $token=$_POST['csrf_token'] ?? $_SERVER['HTTP_X_CSRF_TOKEN'] ?? '';
        
        if(empty($_SESSION['csrf_token']) || empty($token) || !hash_equals($_SESSION['csrf_token'], $token)){
            http_response_code(403);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Token CSRF inválido']);
            return false;
        }
        return true;
    }
}
