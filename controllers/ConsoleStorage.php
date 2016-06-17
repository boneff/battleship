<?php
class ConsoleStorage implements Storage {
    //TODO
    public function storeParameters(array $array)
    {
        foreach ($array as $name => $value) {
            apc_add($name, $value);
        }
    }

    public function storeParameter($paramName, $paramValue)
    {
        apc_add($paramName, $paramValue);
    }


    public function getParameterFromStorage($name)
    {
        return apc_fetch($name);
    }

    public function destroy() {
        apc_clear_cache();
    }

}