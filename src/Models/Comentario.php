<?php
require_once __DIR__ . '/../../config/Database.php';

class Comentario {
    private $id;
    private $contenido;
    private $fecha_comentario;
    private $fecha_borrado;
    private $id_usuario;
    private $id_obra;
    private $revisado;
    
    public function __construct($id,$contenido,$fecha_comentario,$fecha_borrado,$id_usuario,$id_obra,$revisado) {
        $this->id = $id;
        $this->contenido = $contenido;
        $this->fecha_comentario = $fecha_comentario;
        $this->fecha_borrado = $fecha_borrado;
        $this->id_usuario = $id_usuario;
        $this->id_obra = $id_obra;
        $this->revisado = $revisado;
    }

    public static function guardar($contenido,$id_usuario,$id_obra) {
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO comentarios (contenido, id_usuario, id_obra) VALUES (?, ?, ?)");
        $stmt->execute([$contenido, $id_usuario, $id_obra]);
        return $db->lastInsertId();
    }

    public static function crearInstancia($id) {
        $datos=self::obtenerPorId($id);
        if(!$datos) return null;

        $com=new Comentario($datos['id'],$datos['contenido'],$datos['fecha_comentario'],$datos['fecha_borrado'],$datos['id_usuario'],$datos['id_obra'],$datos['revisado']);
        return $com;
    }

    public static function obtenerPorId($id) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM comentarios WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorObra($id_obra) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT c.*, u.nombre_usuario as usuario FROM comentarios c JOIN usuarios u ON c.id_usuario = u.id WHERE c.id_obra=? and c.fecha_borrado is null and u.activo=1 ORDER BY c.fecha_comentario DESC");
        $stmt->execute([$id_obra]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorUsuario($id_usuario) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM comentarios WHERE id_usuario=?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerTodos() {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM comentarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerReportados() {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT c.*,u.nombre_usuario AS usuario FROM comentarios c JOIN usuarios u ON c.id_usuario = u.id JOIN reporte_comentarios rc ON c.id = rc.id_comentario WHERE c.revisado=0 AND c.fecha_borrado is null");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerComentariosSinModerar(){
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT c.*, u.nombre_usuario AS usuario, u.id AS id_usuario FROM comentarios c JOIN usuarios u ON c.id_usuario = u.id WHERE u.moderado=0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function usuarioDioMg($id_usuario,$id_comentario){
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM megusta_comentario WHERE id_usuario=? AND id_comentario=?");
        $stmt->execute([$id_usuario,$id_comentario]);
        return $stmt->fetch() !==false;
    }

    public static function usuarioReporto($id_usuario,$id_comentario){
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM reporte_comentarios WHERE id_usuario=? AND id_comentario=?");
        $stmt->execute([$id_usuario,$id_comentario]);
        return $stmt->fetch() !==false;
    }

    public function getId() {return $this->id;}
    public function getContenido() {return $this->contenido;}
    public function getFechaComentario() {return $this->fecha_comentario;}
    public function getFechaBorrado() {return $this->fecha_borrado;}
    public function getIdUsuario() {return $this->id_usuario;}
    public function getIdObra() {return $this->id_obra;}
    public function getRevisado() {return $this->revisado;}
    
    public function setId($id) {$this->id = $id; $this->actualizar();}
    public function setContenido($contenido) {$this->contenido = $contenido; $this->actualizar();}
    public function setFechaComentario($fecha_comentario) {$this->fecha_comentario = $fecha_comentario; $this->actualizar();}
    public function setFechaBorrado($fecha_borrado) {$this->fecha_borrado = $fecha_borrado; $this->actualizar();}
    public function setIdUsuario($id_usuario) {$this->id_usuario = $id_usuario; $this->actualizar();}
    public function setIdObra($id_obra) {$this->id_obra = $id_obra; $this->actualizar();}
    public function setRevisado($revisado) {$this->revisado = $revisado; $this->actualizar();}

    private function actualizar() {
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE comentarios SET contenido=?, fecha_comentario=?, fecha_borrado=?, id_usuario=?, id_obra=?, revisado=? WHERE id=?");
        $stmt->execute([$this->contenido, $this->fecha_comentario, $this->fecha_borrado, $this->id_usuario, $this->id_obra, $this->revisado, $this->id]);
    }

    public function eliminar() {
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE comentarios SET fecha_borrado=CURRENT_TIMESTAMP, revisado=1 WHERE id=?");
        $datos=$stmt->execute([$this->id]);
        $this->fecha_borrado = date('Y-m-d H:i:s');
        $this->revisado = 1;
    }

    public function recuperar() {
        $this->fecha_borrado = null;
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE comentarios SET fecha_borrado=NULL WHERE id=?");
        $stmt->execute([$this->id]);
    }

    public function reportar($id_usuario) {
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO reporte_comentarios (id_usuario, id_comentario) VALUES (?, ?)");
        $stmt->execute([$id_usuario, $this->id]);
    }

    public function eliminarReporte() {
        $db=Database::conectar();
        $stmt=$db->prepare("DELETE FROM reporte_comentarios WHERE id_comentario=?");
        $stmt->execute([$this->id]);
    }

    public function obtenerReportes() {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM reporte_comentarios WHERE id_comentario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalReportes() {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT COUNT(*) as count FROM reporte_comentarios WHERE id_comentario=?");
        $stmt->execute([$this->id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['count'] > 0) ? (int)$result['count'] : 0;
    }

    public function meGusta($id_usuario) {
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO megusta_comentario (id_usuario, id_comentario) VALUES (?, ?)");
        $stmt->execute([$id_usuario, $this->id]);
    }

    public function eliminarMeGusta($id_usuario) {
        $db=Database::conectar();
        $stmt=$db->prepare("DELETE FROM megusta_comentario WHERE id_usuario=? AND id_comentario=?");
        $stmt->execute([$id_usuario, $this->id]);
    }

    public function obtenerMeGusta() {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM megusta_comentario WHERE id_comentario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalMeGusta() {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT COUNT(*) as count FROM megusta_comentario WHERE id_comentario=?");
        $stmt->execute([$this->id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return ($result['count'] > 0) ? (int)$result['count'] : 0;
    }

    public function revisar(){
        $this->setRevisado(1);
    }
}
?>
