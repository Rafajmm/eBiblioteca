<?php
class Database{
    private static $host=null;
    private static $nombreBD=null;
    private static $usuario=null;
    private static $pass=null;
    private static $conexion=null;
    private static $charset=null;
    private static $port=null;

    public static function conectar(){
        if(self::$conexion==null){
            $rutaConfig=__DIR__.'/env.php';
            $config=require $rutaConfig;
            
            self::$host=$config['DB_HOST'] ?? 'localhost';
            self::$nombreBD=$config['DB_NAME'] ?? 'eBiblioteca';
            self::$usuario=$config['DB_USER'] ?? 'root';
            self::$pass=$config['DB_PASS'] ?? '';
            self::$charset=$config['DB_CHARSET'] ?? 'utf8mb4';
            self::$port=$config['DB_PORT'] ?? 3306;
            try{
                self::$conexion=new PDO('mysql:dbname='.self::$nombreBD.';host='.self::$host.':'.self::$port.';charset='.self::$charset, self::$usuario, self::$pass);
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