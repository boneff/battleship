<?php

namespace Battleships\Storage;

class SessionStorage implements StorageInterface
{
    public function storeParameters(array $array)
    {
        foreach ($array as $name => $value) {
            $_SESSION[$name] = $value;
        }
    }

    public function storeParameter($paramName, $paramValue)
    {
        $_SESSION[$paramName] = $paramValue;
    }


    public function getParameterFromStorage($name)
    {
        return !empty($_SESSION[$name]) ? $_SESSION[$name] : false;
    }

    public function destroy()
    {
        session_destroy();
    }
}
