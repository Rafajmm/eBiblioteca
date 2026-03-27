<?php

class Autor {
    private $id;
    private $nombre;
    private $pais;
    private $fecha_nacimiento;
    private $fecha_registro;
    private $fecha_borrado;
    private $biografia;
    private $foto;

    public function __construct($id, $nombre, $pais, $fecha_nacimiento, $fecha_registro, $fecha_borrado = null, $biografia = null, $foto = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->pais = $pais;
        $this->fecha_nacimiento = $fecha_nacimiento;
        $this->fecha_registro = $fecha_registro;
        $this->fecha_borrado = $fecha_borrado;
        $this->biografia = $biografia;
        $this->foto = $foto;
    }

    public static function guardar($nombre, $pais, $fecha_nacimiento, $biografia) {
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO autores(nombre,pais,fecha_nacimiento,fecha_registro,fecha_borrado,biografia,foto) VALUES (?,?,?,?,?,?,?)");
        return $stmt->execute([$nombre,$pais,$fecha_nacimiento,$biografia]);
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

    public function actualizar($nombre, $pais, $fecha_nacimiento, $biografia, $foto) {
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE autores SET nombre=?, pais=?, fecha_nacimiento=?, biografia=?, foto=? WHERE id=?");
        return $stmt->execute([$nombre,$pais,$fecha_nacimiento,$biografia,$foto,$this->id]);
    }

    public function eliminar(){
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE autores SET fecha_borrado=? WHERE id=?");
        return $stmt->execute([date('Y-m-d H:i:s'),$this->id]);
    }

    public function recuperar(){
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE autores SET fecha_borrado=NULL WHERE id=?");
        return $stmt->execute([$this->id]);
    }

    
    
}
?>
