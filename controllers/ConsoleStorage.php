<?php
class ConsoleStorage implements Storage {
    
    private $storage = [];
    //TODO
    public function storeParameters(array $array)
    {
        foreach ($array as $name => $value) {
            $this->storage[$name] = $value;
        }
    }

    public function storeParameter($paramName, $paramValue)
    {
         $this->storage[$paramName] = $paramValue;
    }


    public function getParameterFromStorage($name)
    {
        return isset($this->storage[$name]) ? $this->storage[$name] : '';
    }

    public function destroy() {
        $this->storage = [];
    }

}