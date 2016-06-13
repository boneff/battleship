<?php
class Autoload {

    public function __construct() {
        spl_autoload_register(array($this, '__autoload'));
    }

    public static function __autoload($className) {
        $class = str_replace('\\', DIRECTORY_SEPARATOR,  $className);
        $requireDirectories = [
            'controllers',
            'models',
            'config'
        ];

        foreach ($requireDirectories as $directoryName) {
            // create the actual filepath
            $filePath = $directoryName . DIRECTORY_SEPARATOR . $class . '.php';

            // check if the file exists
            if(file_exists($filePath))
            {
                require_once $filePath;
            }
        }
    }

}

new Autoload();
