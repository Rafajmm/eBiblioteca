<?php
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Models/Obra.php';

class AutorController {
    public function autores(){
        $nombre=$_GET['nombre'] ?? null;
        $pais=$_GET['pais'] ?? null;
        $epoca=$_GET['epoca'] ?? null;
        $letra=$_GET['letra'] ?? null;
        $pagina=(int)($_GET['pagina'] ?? 1);
        $porPagina=(int)($_GET['porPagina'] ?? 15);

        $autores=$nombre ? Autor::busquedaAvanzada($nombre) : Autor::cargarTodos();

        if($pais){
            $autores=array_filter($autores, function($autor) use ($pais) {
                return $autor['pais'] === $pais;
            });
        }
        if($epoca){
            $autores=array_filter($autores, function($autor) use ($epoca) {
                $anio=(int)substr($autor['fecha_nacimiento'], 0, 4);
                return ceil($anio / 100) === $epoca;
            });
        }
        if($letra){
            $autores=array_filter($autores,function($autor) use($letra){
                return strtoupper(substr($autor['nombre'], 0, 1)) === strtoupper($letra);
            });
        }

        $autores=array_values($autores);
        $total=count($autores);
        $totalPaginas=ceil($total / $porPagina);
        $autores=array_slice($autores, ($pagina - 1) * $porPagina, $porPagina);

        $title="Autores";

        ob_start();
        include __DIR__ . '/../Views/VistaAutores.php';
        $contenido=ob_get_clean();

        require_once __DIR__ . '/../Views/layout.php';
    }
    
    public function verAutor($id){
        $autor=Autor::crearInstancia($id);
        if(!$autor){
            http_response_code(404);
            require_once __DIR__ . '/../Views/404.php';
            return;
        }

        $obras=$autor->mostrarObras();
        $generos=[];
        foreach($obras as $obra){
            if(!in_array($obra['genero'], $generos)){
                $generos[] = $obra['genero'];
            }
        }
        $totalGeneros=count($generos);
        $totalObras=count($obras);
        $title=$autor->getNombre();

        

        ob_start();
        include __DIR__ . '/../Views/VistaPerfilAutor.php';
        $contenido=ob_get_clean();

        require_once __DIR__ . '/../Views/layout.php';
    }

    public function cargarTodos(){
        return Autor::cargarTodos();
    }

    public function crearAutor(){
        
    }
}
