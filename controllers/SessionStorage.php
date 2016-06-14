<?php
/**
 * Created by PhpStorm.
 * User: boneff
 * Date: 14.6.2016 г.
 * Time: 10:09
 */

class SessionStorage implements Storage {

    public function storeParameters(array $array) {
        foreach ($array as $name => $value) {
            $_SESSION[$name] = $value;
        }
    }

    public function storeParameter($paramName, $paramValue) {
        $_SESSION[$paramName] = $paramValue;
    }


    public function getParameterFromStorage($name) {
        return !empty($_SESSION[$name]) ? $_SESSION[$name] : false;
    }

    public function destroy() {
        session_destroy();
    }

}