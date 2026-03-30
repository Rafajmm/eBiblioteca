<?php
require_once __DIR__ . '/../Config/Database.php';

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
        $db=new Database();
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
        $db=new Database();
        $stmt=$db->prepare("SELECT * FROM comentarios WHERE id=?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorObra($id_obra) {
        $db=new Database();
        $stmt=$db->prepare("SELECT * FROM comentarios WHERE id_obra=?");
        $stmt->execute([$id_obra]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerPorUsuario($id_usuario) {
        $db=new Database();
        $stmt=$db->prepare("SELECT * FROM comentarios WHERE id_usuario=?");
        $stmt->execute([$id_usuario]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerTodos() {
        $db=new Database();
        $stmt=$db->prepare("SELECT * FROM comentarios");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function obtenerReportados() {
        $db=new Database();
        $stmt=$db->prepare("SELECT * FROM comentarios join reporte_comentarios on comentarios.id=reporte_comentarios.id_comentario WHERE comentarios.revisado=0");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getId() {return $this->id;}
    public function getContenido() {return $this->contenido;}
    public function getFechaComentario() {return $this->fecha_comentario;}
    public function getFechaBorrado() {return $this->fecha_borrado;}
    public function getIdUsuario() {return $this->id_usuario;}
    public function getIdObra() {return $this->id_obra;}
    public function getRevisado() {return $this->revisado;}
    
    public function setId($id) {$this->id = $id; self::actualiazar();}
    public function setContenido($contenido) {$this->contenido = $contenido; self::actualizar();}
    public function setFechaComentario($fecha_comentario) {$this->fecha_comentario = $fecha_comentario; self::actualizar();}
    public function setFechaBorrado($fecha_borrado) {$this->fecha_borrado = $fecha_borrado; self::actualizar();}
    public function setIdUsuario($id_usuario) {$this->id_usuario = $id_usuario; self::actualizar();}
    public function setIdObra($id_obra) {$this->id_obra = $id_obra; self::actualizar();}
    public function setRevisado($revisado) {$this->revisado = $revisado; self::actualizar();}

    private function actualizar() {
        $db=new Database();
        $stmt=$db->prepare("UPDATE comentarios SET contenido=?, fecha_comentario=?, fecha_borrado=?, id_usuario=?, id_obra=?, revisado=? WHERE id=?");
        $stmt->execute([$this->contenido, $this->fecha_comentario, $this->fecha_borrado, $this->id_usuario, $this->id_obra, $this->revisado, $this->id]);
    }

    public function eliminar() {
        $db=new Database();
        $stmt=$db->prepare("UPDATE comentarios SET fecha_borrado=CURRENT_TIMESTAMP, revisado=1 WHERE id=?");
        $datos=$stmt->execute([$this->id]);
        self::setFechaBorrado($datos['fecha_borrado']);
        self::setRevisado(1);
    }

    public function recuperar() {
        self::setFechaBorrado(null);
        $db=new Database();
        $stmt=$db->prepare("UPDATE comentarios SET fecha_borrado=NULL WHERE id=?");
        $stmt->execute([$this->id]);
    }

    public function revisar() {
        self::setRevisado(1);
        $db=new Database();
        $stmt=$db->prepare("UPDATE comentarios SET revisado=1 WHERE id=?");
        $stmt->execute([$this->id]);
    }

    public function reportar($id_usuario) {
        $db=new Database();
        $stmt=$db->prepare("INSERT INTO reporte_cometarios (id_usuario, id_comentario) VALUES (?, ?)");
        $stmt->execute([$id_usuario, $this->id]);
    }

    public function eliminarReporte() {
        $db=new Database();
        $stmt=$db->prepare("DELETE FROM reporte_comentarios WHERE id_comentario=?");
        $stmt->execute([$this->id]);
    }

    public function obtenerReportes() {
        $db=new Database();
        $stmt=$db->prepare("SELECT * FROM reporte_comentarios WHERE id_comentario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function totalReportes() {
        $db=new Database();
        $stmt=$db->prepare("SELECT COUNT(*) as count FROM reporte_comentarios WHERE id_comentario=?");
        $stmt->execute([$this->id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }

}
?>
