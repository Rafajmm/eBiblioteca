<?php
require_once __DIR__ . '/../Models/Usuario.php';
require_once __DIR__ . '/../Models/Lista.php';


class UsuarioController {
    public function perfil($id_usuario) {
        $datos=Usuario::buscarPorId($id_usuario);
        $usuario=Usuario::crearInstancia($datos['nombre_usuario']);

        if(!$usuario) {
            http_response_code(404);
            echo json_encode(['error' => 'Usuario no encontrado']);
            return;
        }
        
        $seguidores=$usuario->obtenerSeguidores();
        $seguidos=$usuario->obtenerSeguidos();
        $tablon=$usuario->obtenerTablon();
        $listas=Lista::buscarPorUsuario($id_usuario);

        header('Content-Type: application/json');
        echo json_encode([
            'usuario' => $usuario,
            'listas' => $listas
        ]);
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

    }
}
?>
