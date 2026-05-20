<?php

use PHPUnit\Framework\TestCase;
require_once __DIR__ . '/../Unit/ReglasAuth.php';

class AuthTest extends TestCase{
    public function testEmailValido(){
        $this->assertTrue(ReglasAuth::emailValido('usuario@correo.com'));
    }
    public function testEmailInvalido(){
        $this->assertFalse(ReglasAuth::emailValido('usuariocorreo.com'));
    }

    public function testPassValida(){
        $this->assertTrue(ReglasAuth::passValida('passPrueba1!'));
    }
    public function testPassCorta(){
        $this->assertFalse(ReglasAuth::passValida('Pass1!'));
    }
    public function testPassSinMayuscula(){
        $this->assertFalse(ReglasAuth::passValida('passprueba1!'));
    }
    public function testPassSinMinuscula(){
        $this->assertFalse(ReglasAuth::passValida('PASSPRUEBA1!'));
    }
    public function testPassSinNumero(){
        $this->assertFalse(ReglasAuth::passValida('PassPrueba!'));
    }
    public function testPassSinSimbolo(){
        $this->assertFalse(ReglasAuth::passValida('PassPrueba1'));
    }
    public function testPassCoinciden(){
        $this->assertTrue(ReglasAuth::passCoinciden('PassPrueba1!', 'PassPrueba1!'));
    }
    public function testPassNoCoinciden(){
        $this->assertFalse(ReglasAuth::passCoinciden('PassPrueba1!', 'PassPrueba2!'));
    }

    public function testNombreUsuarioValido(){
        $this->assertTrue(ReglasAuth::nombreUsuarioValido('rafa_123'));
    }
    public function testNombreUsuarioEspacio(){
        $this->assertFalse(ReglasAuth::nombreUsuarioValido('rafa 123'));
    }
    public function testNombreUsuarioSimbolo(){
        $this->assertFalse(ReglasAuth::nombreUsuarioValido('rafa-123'));
    }
    public function testNombreUsuarioLargo(){
        $this->assertFalse(ReglasAuth::nombreUsuarioValido('rafa123456789012345678901234567890'));
    }
    public function testNombreUsuarioCorto(){
        $this->assertFalse(ReglasAuth::nombreUsuarioValido('ra'));
    }

    public function testIdentificadorEsEmail(){
        $this->assertTrue(ReglasAuth::identificadorEsEmail('usuario@correo.com'));
    }
    public function testIdentificadorEsNombreUsuario(){
        $this->assertFalse(ReglasAuth::identificadorEsEmail('rafa_123'));
    }

    public function testCamposCompletos(){
        $this->assertTrue(ReglasAuth::registroCompleto('Rafa', 'rafa_123', 'usuario@correo.com', 'PassPrueba1!', 'PassPrueba1!'));
    }
    public function testCamposIncompletos(){
        $this->assertFalse(ReglasAuth::registroCompleto('', 'rafa_123', 'usuario@correo.com', 'PassPrueba1!', 'PassPrueba1!'));
    }
}
