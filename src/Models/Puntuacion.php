<?php
require_once __DIR__ . '/../../config/Database.php';

class Puntuacion {
    private $valor;
    private $id_usuario;
    private $id_obra;
    private $fecha_puntuacion;
   
    public function __construct($valor, $id_usuario, $id_obra, $fecha_puntuacion = null) {
        $this->valor = $valor;
        $this->id_usuario = $id_usuario;
        $this->id_obra = $id_obra;
        $this->fecha_puntuacion = $fecha_puntuacion;
    }

    public function getValor() {
        return $this->valor;
    }    
    public function getIdUsuario() {
        return $this->id_usuario;
    }    
    public function getIdObra() {
        return $this->id_obra;
    }
    public function getFechaPuntuacion() {
        return $this->fecha_puntuacion;
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
        $this->actualizar();
    }
    public function setIdObra($id_obra) {
        $this->id_obra = $id_obra;
        $this->actualizar();
    }
    public function setValor($valor) {
        $this->valor = $valor;
        $this->actualizar();
    }
    public function setFechaPuntuacion($fecha_puntuacion) {
        $this->fecha_puntuacion = $fecha_puntuacion;
        $this->actualizar();
    }
    
    public static function guardar($puntuacion,$id_usuario,$id_obra) {
        $db = Database::conectar();
        $stmt = $db->prepare("INSERT INTO puntuaciones (valor, id_usuario, id_obra) VALUES (?, ?, ?)");
        $stmt->execute([$puntuacion, $id_usuario, $id_obra]);
        return $db->lastInsertId();
    }

    public static function crearInstancia($id_usuario, $id_obra) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM puntuaciones WHERE id_usuario = ? AND id_obra = ?");
        $stmt->execute([$id_usuario, $id_obra]);
        $puntuacion = $stmt->fetch();
        return new Puntuacion($puntuacion['valor'], $puntuacion['id_usuario'], $puntuacion['id_obra'],$puntuacion['fecha_puntuacion']);
    }
    
    public function actualizar() {
        $db = Database::conectar();
        $stmt = $db->prepare("UPDATE puntuaciones SET valor = ?, id_usuario = ?, id_obra = ?, fecha_puntuacion = ? WHERE id_usuario = ? AND id_obra = ?");
        $stmt->execute([$this->valor, $this->id_usuario, $this->id_obra, $this->fecha_puntuacion, $this->id_usuario, $this->id_obra]);
    }

    public function sobreescribir($valor) {
        $db = Database::conectar();
        $stmt = $db->prepare("UPDATE puntuaciones SET valor = ? WHERE id_usuario = ? AND id_obra = ?");
        $stmt->execute([$valor, $this->id_usuario, $this->id_obra]);
    }

    public static function buscarPorUsuarioYObra($id_usuario, $id_obra) {
        $db = Database::conectar();
        $stmt = $db->prepare("SELECT * FROM puntuaciones WHERE id_usuario = ? AND id_obra = ?");
        $stmt->execute([$id_usuario, $id_obra]);
        $puntuacion = $stmt->fetch();
        return new Puntuacion($puntuacion['valor'], $puntuacion['id_usuario'], $puntuacion['id_obra'], $puntuacion['fecha_puntuacion']);
    }
}

?>