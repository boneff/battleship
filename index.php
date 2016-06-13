<?php
//    ini_set('display_errors', 1);
//    ini_set('display_startup_errors', 1);
//    error_reporting(E_ALL);

    require_once 'config/Autoload.php';
    if(php_sapi_name() == "cli") {
        $coordinates = getopt('c:') != false  ? getopt('c:') : [];
        $options = [
            "controller" => "Console",
            "action"     => "index",
            "params"     => [ 'coordinates' => $coordinates ]
        ];
    } else {
        $coordinates = isset($_REQUEST['coordinates']) ? $_REQUEST['coordinates'] : [];
        $options = [
            "controller" => "Web",
            "action"     => "index",
            "params"     => [ 'coordinates' => $coordinates ]
        ];
    }

    $frontController = new FrontController($options);
    $frontController->run();
?>



