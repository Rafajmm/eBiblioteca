<?php
class Database{
    private static $host='localhost';
    private static $nombreBD='eBiblioteca';
    private static $usuario='root';
    private static $pass='';
    private static $conexion=null;

    public static function conectar(){
        if(self::$conexion==null){
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