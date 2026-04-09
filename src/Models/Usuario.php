<?php
require_once __DIR__ . '/../../config/Database.php';

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

    public function __construct($id, $nombre, $nombre_usuario, $correo, $pass, $activo, $es_admin, $moderado, $bio=null, $ruta_foto=null, $fecha_registro) {
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

    public function setNombre($nombre) { $this->nombre = $nombre;  $this->actualizar(); }
    public function setNombreUsuario($nombre_usuario) { $this->nombre_usuario = $nombre_usuario; $this->actualizar(); }
    public function setCorreo($correo) { $this->correo = $correo; $this->actualizar(); }
    public function setPass($pass) { $this->pass = password_hash($pass, PASSWORD_BCRYPT); $this->actualizar(); }
    public function setBio($bio) { $this->bio = $bio; $this->actualizar(); }
    public function setRutaFoto($ruta) { $this->ruta_foto = $ruta; $this->actualizar(); }

    public function getId(){ return $this->id; }
    public function getNombre(){ return $this->nombre; }
    public function getNombreUsuario(){ return $this->nombre_usuario; }
    public function getCorreo(){ return $this->correo; }
    public function getPass(){ return $this->pass; }
    public function getActivo(){ return $this->activo; }
    public function getEsAdmin(){ return $this->es_admin; }
    public function getModerado(){ return $this->moderado; }
    public function getBio(){ return $this->bio; }
    public function getRutaFoto(){ return $this->ruta_foto; }
    public function getFechaRegistro(){ return $this->fecha_registro; }


    public static function guardar($nombre,$nombre_usuario,$correo,$pass){
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO usuarios(nombre,nombre_usuario,correo,pass) VALUES (?,?,?,?)");
        $stmt->execute([$nombre,$nombre_usuario,$correo,password_hash($pass,PASSWORD_BCRYPT)]);
        return $db->lastInsertId();
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
        if(!$datos) return null;

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

    public function seguir($id_seguido){
        $bd=Database::conectar();
        $stmt=$bd->prepare("INSERT INTO seguidores(id_seguidor,id_seguido) VALUES (?,?)");
        return $stmt->execute([$this->id,$id_seguido]);
    }

    public function dejarSeguir($id_seguido){
        $bd=Database::conectar();
        $stmt=$bd->prepare("DELETE FROM seguidores WHERE id_seguidor=? AND id_seguido=?");
        return $stmt->execute([$this->id,$id_seguido]);
    }

    public function obtenerSeguidos(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT * FROM seguidores WHERE id_seguidor=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerSeguidores(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT * FROM seguidores WHERE id_seguido=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarSeguidor($id_seguidor){
        $bd=Database::conectar();
        $stmt=$bd->prepare("DELETE FROM seguidores WHERE id_seguidor=? AND id_seguido=?");
        return $stmt->execute([$id_seguidor,$this->id]);
    }

    public function cargarListas(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT * FROM listas WHERE id_usuario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function crearLista($nombre){
        $bd=Database::conectar();
        $stmt=$bd->prepare("INSERT INTO listas(nombre,id_usuario) VALUES (?,?)");
        return $stmt->execute([$nombre,$this->id]);
    }

    public function obtenerMeGustaC(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT * FROM megusta_comentario WHERE id_usuario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerMeGustaL(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT * FROM megusta_lista WHERE id_usuario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerComentarios(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT * FROM comentarios WHERE id_usuario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerReportes(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT * FROM reporte_comentarios WHERE id_usuario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerPuntuaciones(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT * FROM puntuaciones WHERE id_usuario=?");
        $stmt->execute([$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function obtenerTablon(){
        $bd=Database::conectar();
        $stmt=$bd->prepare("SELECT
                u.nombre_usuario AS actor,
                'lista' AS tipo,
                l.nombre AS objetivo,
                l.fecha_creacion AS fecha,
                l.id AS id_objetivo
            FROM listas l
            JOIN usuarios u ON l.id_usuario = u.id 
            WHERE l.id_usuario IN (SELECT id_seguido FROM seguidores WHERE id_seguidor = ?)
            AND u.activo=1

            UNION ALL

            SELECT 
                u.nombre_usuario AS actor,
                'comentario' AS tipo,
                o.titulo AS objetivo,
                c.fecha_comentario AS fecha,
                o.id AS id_objetivo
            FROM comentarios c
            JOIN usuarios u ON c.id_usuario = u.id
            JOIN obras o ON c.id_obra=o.id 
            WHERE c.id_usuario IN (SELECT id_seguido FROM seguidores WHERE id_seguidor = ?)
            AND u.activo=1 AND c.fecha_borrado IS NULL

            UNION ALL

            SELECT 
                u.nombre_usuario AS actor,
                'puntuacion' AS tipo,
                o.titulo AS objetivo,
                p.fecha_puntuacion AS fecha,
                o.id AS id_objetivo
            FROM puntuaciones p
            JOIN usuarios u ON p.id_usuario = u.id 
            JOIN obras o ON p.id_obra = o.id
            WHERE p.id_usuario IN (SELECT id_seguido FROM seguidores WHERE id_seguidor = ?)
            AND u.activo=1

            UNION ALL

            SELECT 
                u.nombre_usuario AS actor,
                'seguidor' AS tipo,
                u2.nombre_usuario AS objetivo,
                s.fecha_seguimiento AS fecha,
                s.id_seguido AS id_objetivo
            FROM seguidores s
            JOIN usuarios u ON s.id_seguidor = u.id
            JOIN usuarios u2 ON s.id_seguido = u2.id
            WHERE s.id_seguidor IN (SELECT id_seguido FROM seguidores WHERE id_seguidor = ?)
            AND u.activo=1 AND u2.activo=1
        ");

        $stmt->execute([$this->id,$this->id,$this->id,$this->id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>