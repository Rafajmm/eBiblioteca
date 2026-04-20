<?php
require_once __DIR__ . '/../Models/Etiqueta.php';

class EtiquetaController {
    public function obtenerTodas() {
        return Etiqueta::obtenerTodas();
    }
}
