<?php
Class Middleware {
    public static function autenticado() {
        if(!isset($_SESSION['id_usuario'])){
            $esAjax=!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) === 'xmlhttprequest';

            $esFetch=isset($_SERVER['HTTP_ACCEPT']) && strpos($_SERVER['HTTP_ACCEPT'],'aplication/json') !==false;

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
}
