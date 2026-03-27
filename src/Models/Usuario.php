<?php
require_once '../../config/Database.php';

class Usuario{
    private $id;
    private $nombre;
    private $nombre_usuario;
    private $correo;
    private $pass;
    private $activo;
    private $es_admin;
    private $moderado;
    private $bio;
    private $ruta_foto;
    private $fecha_registro;

    public function __construct($id, $nombre, $nombre_usuario, $correo, $pass, $activo, $es_admin, $moderado, $bio, $ruta_foto, $fecha_registro) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->nombre_usuario = $nombre_usuario;
        $this->correo = $correo;
        $this->pass = $pass;
        $this->activo = $activo;
        $this->es_admin = $es_admin;
        $this->moderado = $moderado;
        $this->bio = $bio;
        $this->ruta_foto = $ruta_foto;
        $this->fecha_registro = $fecha_registro;
    }

    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setNombreUsuario($nombre_usuario) { $this->nombre_usuario = $nombre_usuario; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setPass($pass) { $this->pass = password_hash($pass, PASSWORD_BCRYPT); }
    public function setBio($bio) { $this->bio = $bio; }
    public function setRutaFoto($ruta) { $this->ruta_foto = $ruta; }

    public static function guardar($nombre,$nombre_usuario,$correo,$pass){
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO usuarios(nombre,nombre_usuario,correo,pass) VALUES (?,?,?,?)");
        return $stmt->execute([$nombre,$nombre_usuario,$correo,password_hash($pass,PASSWORD_BCRYPT)]);
    }

    public static function buscarPorUsuario($nombre_usuario){
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM usuarios WHERE nombre_usuario=?");
        $stmt->execute([$nombre_usuario]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function buscarPorId($id){
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM usuarios WHERE id=?");
        $stmt->execute([$id]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function crearInstancia($nombre_usuario){
        $datos=self::buscarPorUsuario($nombre_usuario);
        if(!datos) return null;

        $usu=new Usuario($datos['id'],$datos['nombre'],$datos['nombre_usuario'],$datos['correo'],$datos['pass'],$datos['activo'],$datos['es_admin'],$datos['moderado'],$datos['bio'],$datos['ruta_foto'],$datos['fecha_registro']);
        return $usu;
    }

    public function actualizar(){
        $datos=self::buscarPorId($this->id);
        if(!$datos) return null;

        $bd=Database::conectar();
        $stmt=$bd->prepare("UPDATE usuarios SET 
            nombre=?,
            nombre_usuario=?,
            correo=?,
            pass=?,
            activo=?,
            es_admin=?,
            moderado=?,
            bio=?,
            ruta_foto=? WHERE
            id=?    
        ");

        return $stmt->execute([
            $this->nombre,
            $this->nombre_usuario,
            $this->correo,
            $this->pass,
            $this->activo,
            $this->es_admin,
            $this->moderado,
            $this->bio,
            $this->ruta_foto,
            $this->id
        ]);
    }

    public function banear(){
        $this->activo=0;
        $this->moderado=0;
        $this->es_admin=0;
        return $this->actualizar();
    }
    public function fiable(){
        $this->moderado=1;
        return $this->actualizar();
    }
    public function hacerAdmin(){
        $this->es_admin=1;
        return $this->actualizar();
    }
    public function activar(){
        $this->activo=1;
        return $this->actualizar();
    }

    

}
?>