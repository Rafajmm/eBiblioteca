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
        $porPagina=(int)($_GET['porPagina'] ?? 12);

        $autores=$nombre ? Autor::busquedaAvanzada($nombre) : Autor::cargarTodos();

        if($pais){
            $autores=array_filter($autores, function($autor) use ($pais) {
                return $autor['pais'] === $pais;
            });
        }
        if($epoca){
            if($epoca==='anterior'){
                $autores=array_filter($autores,function($autor){
                    $anio=(int)substr($autor['fecha_nacimiento'], 0, 4);
                    return $anio < 1400;
                });
            }
            else{
                $autores=array_filter($autores, function($autor) use ($epoca) {
                    $anio=(int)substr($autor['fecha_nacimiento'], 0, 4);
                    return ceil($anio / 100) == $epoca;
                });
            }
        }
        if($letra){
            $autores=array_filter($autores,function($autor) use($letra){
                return strtoupper(substr($autor['nombre'], 0, 1)) === strtoupper($letra);
            });
        }

        $autores=array_values($autores);
        $paises=Autor::cargarPaises();
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
            ob_start();
            include __DIR__ . '/../Views/404.php';
            $contenido = ob_get_clean();
            require_once __DIR__ . '/../Views/layout.php';
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
        $nombre=trim($_POST['nombre'] ?? '');
        $pais=trim($_POST['pais'] ?? '');
        $fecha_nacimiento=trim($_POST['fechaNacimiento'] ?? '');
        $biografia=trim($_POST['biografia'] ?? '');

        if(empty($nombre) || empty($pais) || empty($fecha_nacimiento) || empty($biografia)) {
            http_response_code(400);
            header('Content-Type: application/json');
            echo json_encode(['error' => 'Todos los campos son obligatorios']);
            return;
        }
        
        $id=Autor::guardar($nombre, $pais, $fecha_nacimiento, $biografia);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true, 'id' => $id]);
    }

    public function editarAutor($id){
        $id=(int)$id;
        $autor=Autor::crearInstancia($id);
        if(!$autor){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Autor no encontrado']);
            return;
        }
        
        $nombre=trim($_POST['edNombreAutor'] ?? '');
        $pais=trim($_POST['edPais'] ?? '');
        $fecha_nacimiento=trim($_POST['edFechaNacimiento'] ?? '');
        $biografia=trim($_POST['edBiografia'] ?? '');
        
        if(!empty($nombre)) $autor->setNombre($nombre);
        if(!empty($pais)) $autor->setPais($pais);
        if(!empty($fecha_nacimiento)) $autor->setFechaNacimiento($fecha_nacimiento);
        if(!empty($biografia)) $autor->setBiografia($biografia);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function eliminarAutor($id){
        $id=(int)$id;
        $autor=Autor::crearInstancia($id);
        if(!$autor){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Autor no encontrado']);
            return;
        }
        
        $autor->eliminar();
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function activarAutor($id){
        $id=(int)$id;
        $autor=Autor::crearInstancia($id);
        if(!$autor){
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(['error'=>'Autor no encontrado']);
            return;
        }
        
        $autor->setFechaBorrado(null);
        
        header('Content-Type: application/json');
        echo json_encode(['ok'=>true]);
    }

    public function cargarTodosParaAdmin(){
        return Autor::cargarTodosParaAdmin();
    }
}
