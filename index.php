<?php
    require_once  __DIR__ . '/vendor/autoload.php';
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    $controller = \Battleships\Factories\ControllerFactory::make(php_sapi_name());
    $controller->index();
