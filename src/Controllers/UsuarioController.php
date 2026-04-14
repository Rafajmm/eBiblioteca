<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Lista.php';


class UsuarioController {
    public function verPerfil($id_usuario) {
        $id_sesion=$_SESSION['id_usuario'] ?? null;
        $esPerfilUsuario=($id_sesion!==null && $id_sesion==$id_usuario);

        $datos=Usuario::buscarPorId($id_usuario);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);

        if(!$usuario) {
            http_response_code(404);
            require_once __DIR__ . '/../Views/404.php';
            return;
        }

        if($esPerfilUsuario){
            $tablon=$usuario->obtenerTablon();
        }
        else{
            $tablon=$usuario->obtenerActividad();
        }
        
        $seguidores=$usuario->obtenerSeguidores();
        $seguidos=$usuario->obtenerSeguidos();
        
        $listas=Lista::buscarPorUsuario($id_usuario);
        $title=htmlspecialchars($usuario->getNombreUsuario());

        

        $esSeguido=false;
        if($id_sesion && !$esPerfilUsuario){
            $datosActor=Usuario::buscarPorId($id_sesion);
            $actor=Usuario::crearInstancia($datosActor['nombre_usuario']);
            $esSeguido=$actor->seguidores()->contains($id_usuario);
        }


        ob_start();
        require_once __DIR__ . '/../Views/VistaUsuario.php';
        $contenido=ob_get_clean();

        require_once __DIR__ . '/../Views/layout.php';
    }

    public function actualizar($id_usuario) {
        $datos=Usuario::buscarPorId($id_usuario);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);

        if(!$usuario) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
            return;
        }

        $datosActualizados=json_decode(file_get_contents('php://input'), true);

        $datosActualizados['nombre'] ? $usuario->setNombre($datosActualizados['nombre']) : null;
        $datosActualizados['nombre_usuario'] ? $usuario->setNombreUsuario($datosActualizados['nombre_usuario']) : null;
        $datosActualizados['correo'] ? $usuario->setCorreo($datosActualizados['correo']) : null;
        $datosActualizados['pass'] ? $usuario->setPass($datosActualizados['pass']) : null;
        $datosActualizados['bio'] ? $usuario->setBio($datosActualizados['bio']) : null;
        $datosActualizados['ruta_foto'] ? $usuario->setRutaFoto($datosActualizados['ruta_foto']) : null;

        $usuario->actualizar();
    }
}
?>
