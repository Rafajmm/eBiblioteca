<?php

/**
 * Punto de entrada de la aplicación
 * 
 * QUÉ: Archivo principal que recibe todas las peticiones HTTP
 * CÓMO: Carga el sistema de rutas y despacha la petición actual
 * POR QUÉ: Centraliza el flujo de la aplicación para URLs limpias
 */

// Definir constante de ruta raíz del proyecto
// QUÉ: Establece la ruta absoluta al directorio raíz
// CÓMO: Usa dirname(__DIR__) para subir un nivel desde public/
// POR QUÉ: Permite referencias absolutas en toda la aplicación
define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);

// Iniciar sesión si no está iniciada
// QUÉ: Activa el sistema de sesiones de PHP
// CÓMO: Verifica si hay sesión activa antes de iniciar
// POR QUÉ: Necesario para autenticación y datos de usuario
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Configurar manejo de errores
// QUÉ: Establece cómo se muestran los errores PHP
// CÓMO: Activa display_errors en desarrollo
// POR QUÉ: Facilita debugging durante desarrollo
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Cargar el archivo de rutas
// QUÉ: Incluye la configuración de todas las rutas
// CÓMO: Require del archivo routes.php que contiene el Router
// POR QUÉ: El archivo routes.php se encarga de despachar la petición
require_once ROOT_PATH . 'config/routes.php';

// NOTA: El dispatch() se ejecuta automáticamente al final de routes.php
