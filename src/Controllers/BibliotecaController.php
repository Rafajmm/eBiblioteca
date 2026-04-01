<?php
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Models/Comentario.php';
require_once __DIR__ . '/../Modedels/Puntuacion.php';
require_once __DIR__ . '/../Modedels/Etiqueta.php';

class BibliotecaController {
    public function catalogo() {
        $busqueda=$_GET['busqueda'] ?? null;
        $genero=$_GET['genero'] ?? null;
        $autor=$_GET['autor'] ?? null;
        $pagina=$_GET['pagina'] ?? 1;
        $porPagina=$_GET['porPagina'] ?? 16;
    }
}
?>
