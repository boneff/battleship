<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once 'config/Autoload.php';
    if(php_sapi_name() == "cli") {
        $options = [
            "controller" => "Console",
            "action"     => "index",
            "params"     => [ ]
        ];
    } else {
        session_start();
        $options = [
            "controller" => "Web",
            "action"     => "index",
            "params"     => [ ]
        ];
    }

    $frontController = new FrontController($options);
    $frontController->run();
?>



