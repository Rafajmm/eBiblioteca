<?php
require_once __DIR__ . '/../Config/Database.php';

class Autor {
    private $id;
    private $nombre;
    private $pais;
    private $fecha_nacimiento;
    private $fecha_registro;
    private $fecha_borrado;
    private $biografia;
    private $ruta_foto;

    public function __construct($id, $nombre, $pais, $fecha_nacimiento, $fecha_registro, $fecha_borrado = null, $biografia = null, $ruta_foto = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pais = $pais;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->fecha_registro = $fecha_registro;
        $this->fecha_borrado = $fecha_borrado;
        $this->biografia = $biografia;
        $this->ruta_foto = $ruta_foto;
    }

    public static function guardar($nombre, $pais, $fecha_nacimiento, $biografia) {
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO autores(nombre,pais,fecha_nacimiento,biografia) VALUES (?,?,?,?)");
        $stmt->execute([$nombre,$pais,$fecha_nacimiento,$biografia]);
        return $db->lastInsertId();
    }

    public static function buscarPorId($id) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM autores WHERE id=?");
        $stmt->execute([$id]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function buscarPorNombre($nombre) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM autores WHERE nombre=?");
        $stmt->execute([$nombre]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function buscarPorPais($pais) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM autores WHERE pais=?");
        $stmt->execute([$pais]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }   

    public static function buscarPorFechaNacimiento($fecha_nacimiento) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM autores WHERE fecha_nacimiento=?");
        $stmt->execute([$fecha_nacimiento]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }
    
    public static function obtenerId($nombre,$fecha_nacimiento) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT id FROM autores WHERE nombre=? AND fecha_nacimiento=?");
        $stmt->execute([$nombre,$fecha_nacimiento]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos['id'];
        }
        return null;
    }

    public static function crearInstancia($id) {
        $datos=self::buscarPorId($id);
        if(!$datos) return null;

        $autor=new Autor($datos['id'],$datos['nombre'],$datos['pais'],$datos['fecha_nacimiento'],$datos['fecha_registro'],$datos['fecha_borrado'],$datos['biografia'],$datos['ruta_foto']);
        return $autor;
    }

    public static function cargarTodos() {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM autores");
        $stmt->execute();
        $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public function actualizar() {
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE autores SET nombre=?, pais=?, fecha_nacimiento=?, biografia=?, ruta_foto=? WHERE id=?");
        return $stmt->execute([$this->nombre,$this->pais,$this->fecha_nacimiento,$this->biografia,$this->ruta_foto,$this->id]);
    }

    public function eliminar(){
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE autores SET fecha_borrado=CURRENT_TIMESTAMP WHERE id=?");
        return $stmt->execute([$this->id]);
    }

    public function recuperar(){
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE autores SET fecha_borrado=NULL WHERE id=?");
        return $stmt->execute([$this->id]);
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        $this->actualizar();
    }

    public function setPais($pais) {
        $this->pais = $pais;
        $this->actualizar();
    }

    public function setFechaNacimiento($fecha_nacimiento) {
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->actualizar();
    }

    public function setFechaBorrado($fecha_borrado) {
        $this->fecha_borrado = $fecha_borrado;
        $this->actualizar();
    }

    public function setBiografia($biografia) {
        $this->biografia = $biografia;
        $this->actualizar();
    }

    public function setruta_foto($ruta_foto) {
        $this->ruta_foto = $ruta_foto;
        $this->actualizar();
    }
    
    
    public function getId() {
        return $this->id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function getPais() {
        return $this->pais;
    }
    
    public function getFechaNacimiento() {
        return $this->fecha_nacimiento;
    }
    
    public function getFechaRegistro() {
        return $this->fecha_registro;
    }
    
    public function getFechaBorrado() {
        return $this->fecha_borrado;
    }
    
    public function getBiografia() {
        return $this->biografia;
    }
    
    public function getruta_foto() {
        return $this->ruta_foto;
    }
}
?>
