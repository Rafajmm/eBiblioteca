<?php
require_once __DIR__ . '/../Models/Obra.php';
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Models/Comentario.php';
require_once __DIR__ . '/../Modedels/Puntuacion.php';
require_once __DIR__ . '/../Modedels/Etiqueta.php';

class BibliotecaController {
    public function catalogo() {
        $busqueda=$_GET['parametro'] ?? null;
        $genero=$_GET['genero'] ?? null;
        $autor=$_GET['autor'] ?? null;
        $pagina=$_GET['pagina'] ?? 1;
        $porPagina=$_GET['porPagina'] ?? 15;

        if($busqueda){
            $obras=Obra::buscarTodo($busqueda);
        }
        else{
            $obras=Obra::obtenerTodas();
        }
        if($obras && $genero && $autor){
            $obras=array_filter($obras,function($obra) use ($genero, $autor){
                return $obra['genero']===$genero && $obra['autor']===$autor;
            });

            $obras=array_values($obras);
        }
        elseif($obras && $genero){
            $obras=array_filter($obras,function($obra) use ($genero){
                return $obra['genero']===$genero;
            });

            $obras=array_values($obras);
        }
        elseif($obras && $autor){
            $obras=array_filter($obras,function($obra) use ($autor){
                return $obra['autor']===$autor;
            });

            $obras=array_values($obras);
        }
    }
}
?>
