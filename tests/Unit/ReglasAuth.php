<?php
class ReglasAuth{
    public static function emailValido($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    }
    
    public static function passValida($pass){
        if(strlen($pass) < 8){
            return false;
        }
        $patron = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).+$/';
        return preg_match($patron, $pass)===1;
    }
    
    public static function nombreUsuarioValido($nombreUsuario){
        $patron = '/^[a-zA-Z0-9_]{3,30}$/';
        return preg_match($patron, $nombreUsuario)===1;
    }

    public static function identificadorEsEmail($identificador){
        return strpos($identificador, '@') !== false;
    }

    public static function passCoinciden($pass,$passConfirmacion){
        return $pass === $passConfirmacion;
    }

    public static function registroCompleto($nombre,$nombreUsuario,$email,$pass,$passConfirmacion){
        return !empty($nombre) && 
               !empty($nombreUsuario) && 
               !empty($email) && 
               !empty($pass) && 
               !empty($passConfirmacion);
    }
}
