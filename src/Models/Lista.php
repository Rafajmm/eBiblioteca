<?php
require_once __DIR__ . '/../../config/Database.php';

class Lista {
    private $id;
    private $nombre;
    private $descripcion;
    private $id_usuario;
    private $fecha_creacion;

    public function __construct($id = null, $nombre = null, $descripcion = null, $id_usuario = null, $fecha_creacion = null) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->descripcion = $descripcion;
        $this->id_usuario = $id_usuario;
        $this->fecha_creacion = $fecha_creacion;
    }

    public function getId() {
        return $this->id;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function getDescripcion() {
        return $this->descripcion;
    }

    public function getIdUsuario() {
        return $this->id_usuario;
    }

    public function getFechaCreacion() {
        return $this->fecha_creacion;
    }

    public function setId($id) {
        $this->id = $id;
        $this->actualizar();
    }

    public function setNombre($nombre) {
        $this->nombre = $nombre;
        $this->actualizar();
    }

    public function setDescripcion($descripcion) {
        $this->descripcion = $descripcion;
        $this->actualizar();
    }

    public function setIdUsuario($id_usuario) {
        $this->id_usuario = $id_usuario;
        $this->actualizar();
    }

    public function setFechaCreacion($fecha_creacion) {
        $this->fecha_creacion = $fecha_creacion;
        $this->actualizar();
    }
    
    public function actualizar() {
        $bd = Database::conectar();
        $stmt = $bd->prepare("UPDATE listas SET nombre = ?, descripcion = ?, id_usuario = ?, fecha_creacion = ? WHERE id = ?");
        $stmt->execute([$this->nombre, $this->descripcion, $this->id_usuario, $this->fecha_creacion, $this->id]);
    }

    public static function guardar($nombre, $descripcion, $id_usuario) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("INSERT INTO listas(nombre, descripcion, id_usuario) VALUES (?, ?, ?)");
        $stmt->execute([$nombre, $descripcion, $id_usuario]);
        return $bd->lastInsertId();
    }

    public static function crearInstancia($id) {
        $datos=self::buscarPorId($id);
        if(!$datos) return null;

        $lista=new Lista($datos['id'], $datos['nombre'], $datos['descripcion'], $datos['id_usuario'], $datos['fecha_creacion']);
        return $lista;
    }
    
    public static function buscarPorId($id) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT * FROM listas WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch();
    }

    public static function buscarPorNombre($nombre) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT * FROM listas WHERE nombre = ?");
        $stmt->execute([$nombre]);
        return $stmt->fetch();
    }

    public static function buscarPorUsuario($id_usuario) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT * FROM listas WHERE id_usuario = ?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll();
    }

    public static function eliminarPorId($id) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("DELETE FROM listas WHERE id = ?");
        $stmt->execute([$id]);
    }

    public static function obtenerObrasPorId($id) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT id_obra FROM lista_obras WHERE id_lista = ?");
        $stmt->execute([$id]);
        return $stmt->fetchAll();
    }

    public static function obtenerColecciones() {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT * FROM listas WHERE id_usuario = 0");
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function eliminar() {
        $bd = Database::conectar();
        $stmt = $bd->prepare("DELETE FROM listas WHERE id = ?");
        $stmt->execute([$this->id]);
    }
    
    public function addObra($id_obra) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("INSERT INTO lista_obras(id_lista, id_obra) VALUES (?, ?)");
        $stmt->execute([$this->id, $id_obra]);
    }

    public function eliminarObra($id_obra) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("DELETE FROM lista_obras WHERE id_lista = ? AND id_obra = ?");
        $stmt->execute([$this->id, $id_obra]);
    }

    public function obtenerObras() {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT id_obra FROM lista_obras WHERE id_lista = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }

    public function obtenerObrasConDetalles() {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT o.* FROM lista_obras lo JOIN obras o ON lo.id_obra = o.id WHERE lo.id_lista = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }

    public function meGusta($id_usuario) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("INSERT INTO megusta_lista(id_lista, id_usuario) VALUES (?, ?)");
        $stmt->execute([$this->id, $id_usuario]);
    }

    public function quitarMeGusta($id_usuario) {
        $bd = Database::conectar();
        $stmt = $bd->prepare("DELETE FROM megusta_lista WHERE id_lista = ? AND id_usuario = ?");
        $stmt->execute([$this->id, $id_usuario]);
    }

    public function obtenerMeGusta() {
        $bd = Database::conectar();
        $stmt = $bd->prepare("SELECT * FROM megusta_lista WHERE id_lista = ?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll();
    }

    public function copiarLista($id_usuario) {        
        $id = Lista::guardar($this->nombre, $id_usuario);
        $nuevaLista=Lista::crearInstancia($id);
        $obras = self::obtenerObras();
        foreach ($obras as $obra) {
            $nuevaLista->addObra($obra['id_obra']);
        }
        return $nuevaLista;
    }
}
?>
