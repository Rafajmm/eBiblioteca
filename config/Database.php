<?php
class Database{
    private static $host=null;
    private static $nombreBD=null;
    private static $usuario=null;
    private static $pass=null;
    private static $conexion=null;

    public static function conectar(){
        if(self::$conexion==null){
            self::$host=getenv('DB_HOST') ?: 'localhost';
            self::$nombreBD=getenv('DB_NAME') ?: 'eBiblioteca';
            self::$usuario=getenv('DB_USER') ?: 'root';
            self::$pass=getenv('DB_PASS') ?: '';
            try{
                self::$conexion=new PDO('mysql:dbname='.self::$nombreBD.';host='.self::$host.';charset=utf8mb4',self::$usuario,self::$pass);
                self::$conexion->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
            }
            catch(PDOException $e){
                die("Error al conectar a la base de datos: ".$e->getMessage());
            }
        }
        return self::$conexion;
    }
}

?>