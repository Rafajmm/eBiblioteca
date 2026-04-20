<?php
require_once __DIR__ . '/../Models/Autor.php';
require_once __DIR__ . '/../Models/Obra.php';

class AutorController {
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
