<?php

class Obra {
    private $id;
    private $titulo;
    private $sinopsis;
    private $paginas;
    private $fecha_publicacion;
    private $fecha_registro;
    private $fecha_borrado;
    private $ruta_pdf;
    private $ruta_html;
    private $genero;
    

    public function __construct($id, $titulo, $sinopsis, $paginas, $fecha_publicacion, $fecha_registro, $fecha_borrado, $ruta_pdf, $ruta_html, $genero) {
        $this->id = $id;
        $this->titulo = $titulo;
        $this->sinopsis = $sinopsis;
        $this->paginas = $paginas;
        $this->fecha_publicacion = $fecha_publicacion;
        $this->fecha_registro = $fecha_registro;
        $this->fecha_borrado = $fecha_borrado;
        $this->ruta_pdf = $ruta_pdf;
        $this->ruta_html = $ruta_html;
        $this->genero = $genero;
    }

    public static function guardar($titulo, $sinopsis, $paginas, $fecha_publicacion, $ruta_pdf=null, $ruta_html=null, $genero) {
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO obras(titulo,sinopsis,paginas,fecha_publicacion,fecha_registro,fecha_borrado,ruta_pdf,ruta_html,genero) VALUES (?,?,?,?,?,?,?,?,?)");
        return $stmt->execute([$titulo,$sinopsis,$paginas,$fecha_publicacion,$ruta_pdf,$ruta_html,$genero]);
    }

    public static function buscarPorId($id) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obras WHERE id=?");
        $stmt->execute([$id]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function buscarPorTitulo($titulo) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obras WHERE titulo=?");
        $stmt->execute([$titulo]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function buscarPorGenero($genero) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obras WHERE genero=?");
        $stmt->execute([$genero]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }   

    public static function buscarPorFechaPublicacion($fecha_publicacion) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obras WHERE fecha_publicacion=?");
        $stmt->execute([$fecha_publicacion]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }   

    public static function cargarTodas() {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obras");
        $stmt->execute();
        $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function buscarPorEtiqueta($etiqueta) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obras join obra_etiquetas on obras.id=obra_etiquetas.id_obra join etiquetas on obra_etiquetas.id_etiqueta=etiquetas.id WHERE etiquetas.nombre=?");
        $stmt->execute([$etiqueta]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function buscarPorAutor($autor) {
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obras join obra_autores on obras.id=obra_autores.id_obra join autores on obra_autores.id_autor=autores.id WHERE autores.nombre=?");
        $stmt->execute([$autor]);
        $datos=$stmt->fetch(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public static function buscarPorPais($pais){
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obras join obra_autores on obras.id=obra_autores.id_obra join autores on obra_autores.id_autor=autores.id WHERE autores.pais=?");
        $stmt->execute([$pais]);
        $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public function actualizar(){
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE obras SET titulo=?, sinopsis=?, paginas=?, fecha_publicacion=?, fecha_registro=?, fecha_borrado=?, ruta_pdf=?, ruta_html=?, genero=? WHERE id=?");
        $stmt->execute([$this->titulo, $this->sinopsis, $this->paginas, $this->fecha_publicacion, $this->fecha_registro, $this->fecha_borrado, $this->ruta_pdf, $this->ruta_html, $this->genero, $this->id]);
        return $stmt->rowCount() > 0;
    }

    public function actualizarAutor(){
        $db=Database::conectar();
        $stmt=$db->prepare("UPDATE obra_autores SET id_autor=? WHERE id_obra=?");
        $stmt->execute([$this->id_autor, $this->id_obra]);
        return $stmt->rowCount() > 0;
    }

    public function addAutor($idAutor){
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO obra_autores (id_autor,id_obra) VALUES (?, ?)");
        $stmt->execute([$idAutor, $this->id]);
        return $stmt->rowCount() > 0;
    }

    public function eliminarAutor($idAutor){
        $db=Database::conectar();
        $stmt=$db->prepare("DELETE FROM obra_autores WHERE id_obra=? AND id_autor=?");
        $stmt->execute([$this->id, $idAutor]);
        return $stmt->rowCount() > 0;
    }

    public function addEtiqueta($idEtiqueta){
        $db=Database::conectar();
        $stmt=$db->prepare("INSERT INTO obra_etiquetas (id_etiqueta,id_obra) VALUES (?, ?)");
        $stmt->execute([$idEtiqueta, $this->id]);
        return $stmt->rowCount() > 0;
    }

    public function eliminarEtiqueta($idEtiqueta){
        $db=Database::conectar();
        $stmt=$db->prepare("DELETE FROM obra_etiquetas WHERE id_obra=? AND id_etiqueta=?");
        $stmt->execute([$this->id, $idEtiqueta]);
        return $stmt->rowCount() > 0;
    }

    public function getAutores(){
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obra_autores join autores on obra_autores.id_autor=autores.id WHERE id_obra=?");
        $stmt->execute([$this->id]);
        $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }

    public function getEtiquetas(){
        $db=Database::conectar();
        $stmt=$db->prepare("SELECT * FROM obra_etiquetas join etiquetas on obra_etiquetas.id_etiqueta=etiquetas.id WHERE id_obra=?");
        $stmt->execute([$this->id]);
        $datos=$stmt->fetchAll(PDO::FETCH_ASSOC);
        if($datos){
            return $datos;
        }
        return null;
    }


    public function setTitulo($titulo){
        $this->titulo = $titulo;
        $this->actualizar();
    }
    public function setSinopsis($sinopsis){
        $this->sinopsis = $sinopsis;
        $this->actualizar();
    }
    public function setPaginas($paginas){
        $this->paginas = $paginas;
        $this->actualizar();
    }
    public function setfechaPublicacion($fechaPublicacion){
        $this->fecha_publicacion = $fechaPublicacion;
        $this->actualizar();
    }
    public function setFechaRegistro($fechaRegistro){
        $this->fecha_registro = $fechaRegistro;
        $this->actualizar();
    }
    public function setFechaBorrado($fechaBorrado){
        $this->fecha_borrado = $fechaBorrado;
        $this->actualizar();
    }
    public function setRutaPdf($rutaPdf){
        $this->ruta_pdf = $rutaPdf;
        $this->actualizar();
    }
    public function setRutaHTML($rutaHTML){
        $this->ruta_html = $rutaHTML;
        $this->actualizar();
    }
    public function setGenero($genero){
        $this->genero = $genero;
        $this->actualizar();
    }
    

    public function getId(){
        return $this->id;
    }
    public function getTitulo(){
        return $this->titulo;
    }
    public function getSinopsis(){
        return $this->sinopsis;
    }
    public function getPaginas(){
        return $this->paginas;
    }
    public function getFechaPublicacion(){
        return $this->fecha_publicacion;
    }
    public function getFechaRegistro(){
        return $this->fecha_registro;
    }
    public function getFechaBorrado(){
        return $this->fecha_borrado;
    }
    public function getRutaPdf(){
        return $this->ruta_pdf;
    }
    public function getRutaHTML(){
        return $this->ruta_html;
    }
    public function getGenero(){
        return $this->genero;
    }
}

?>
