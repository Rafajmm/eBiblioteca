<?php
use PHPUnit\Framework\TestCase;
require_once __DIR__.'/../../config/Database.php';
require_once __DIR__.'/../../src/Models/Usuario.php';

class IntegracionTest extends TestCase{
    private array $idsCreados=[];

    protected function tearDown(): void{
        $db=Database::conectar();

        foreach($this->idsCreados as $id){
            $stmt=$db->prepare("DELETE FROM usuarios WHERE id=?");
            $stmt->execute([$id]);
        }

        $this->idsCreados=[];
    }

    public function testGuardarYBuscarUsuarioPorId(){
        $sufijo=uniqid();
        $nombreUsuario='test_'.$sufijo;
        $correo='test_'.$sufijo.'@correo.com';
        $pass='passPrueba1!';

        $id=Usuario::guardar('Usuario test',$nombreUsuario, $correo, $pass);
        $this->idsCreados[]=$id;
        $this->assertNotEmpty($id);
        $usuario=Usuario::buscarPorId($id);
        $this->assertNotNull($usuario);
        $this->assertEquals('Usuario test', $usuario['nombre']);
        $this->assertEquals($nombreUsuario, $usuario['nombre_usuario']);
        $this->assertEquals($correo, $usuario['correo']);
    }

    public function testBuscarUsuarioPorCorreo(){
        $sufijo=uniqid();
        $nombreUsuario='test_'.$sufijo;
        $correo='test_'.$sufijo.'@correo.com';
        $pass='passPrueba1!';

        $id=Usuario::guardar('Usuario test',$nombreUsuario, $correo, $pass);
        $this->idsCreados[]=$id;
        $this->assertNotEmpty($id);
        $usuario=Usuario::buscarPorCorreo($correo);
        $this->assertNotNull($usuario);
        $this->assertEquals('Usuario test', $usuario['nombre']);
        $this->assertEquals($nombreUsuario, $usuario['nombre_usuario']);
        $this->assertEquals($correo, $usuario['correo']);
    }

    public function testBuscarUsuarioPorNombreUsuario(){
        $sufijo=uniqid();
        $nombreUsuario='test_'.$sufijo;
        $correo='test_'.$sufijo.'@correo.com';
        $pass='passPrueba1!';

        $id=Usuario::guardar('Usuario test',$nombreUsuario, $correo, $pass);
        $this->idsCreados[]=$id;
        $this->assertNotEmpty($id);
        $usuario=Usuario::buscarPorUsuario($nombreUsuario);
        $this->assertNotNull($usuario);
        $this->assertEquals('Usuario test', $usuario['nombre']);
        $this->assertEquals($nombreUsuario, $usuario['nombre_usuario']);
        $this->assertEquals($correo, $usuario['correo']);
    }

    public function testPassHasheada(){
        $sufijo=uniqid();
        $nombreUsuario='test_'.$sufijo;
        $correo='test_'.$sufijo.'@correo.com';
        $pass='passPrueba1!';

        $id=Usuario::guardar('Usuario test',$nombreUsuario, $correo, $pass);
        $this->idsCreados[]=$id;
        $this->assertNotEmpty($id);
        $usuario=Usuario::buscarPorId($id);
        $this->assertNotNull($usuario);
        $this->assertNotEquals($pass, $usuario['pass']);
        $this->assertTrue(password_verify($pass, $usuario['pass']));
    }
}
