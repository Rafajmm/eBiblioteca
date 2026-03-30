<?php
require_once __DIR__ . '/Database.php';

class Etiqueta {
    private $id;
    private $nombre;
    
    public function __construct($id, $nombre) {
        $this->id = $id;
        $this->nombre = $nombre;
    }
    
    public function getId() {
        return $this->id;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function setId($id) {
        $this->id = $id;
    }
    
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    public static function guardar($nombre) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("INSERT INTO etiquetas(nombre) VALUES (?)");
        $stmt->execute([$nombre]);
        return $bd->lastInsertId();         
    }

    public static function crearInstancia($id) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT * FROM etiquetas WHERE id = ?");
        $stmt->execute([$id]);
        $etiqueta = $stmt->fetch();
        return new Etiqueta($etiqueta['id'], $etiqueta['nombre']);
    }

    public static function obtenerTodas() {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT * FROM etiquetas");
        $stmt->execute();
        $etiquetas = $stmt->fetchAll();
        return array_map(function($etiqueta) {
            return new Etiqueta($etiqueta['id'], $etiqueta['nombre']);
        }, $etiquetas);
    }
}
?>