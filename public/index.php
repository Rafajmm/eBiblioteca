<?php


define('ROOT_PATH', dirname(__DIR__) . DIRECTORY_SEPARATOR);


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once ROOT_PATH . 'config/routes.php';
