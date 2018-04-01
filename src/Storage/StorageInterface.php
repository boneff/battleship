<?php

namespace Battleships\Storage;

interface StorageInterface
{
    public function storeParameter($paramName, $paramValue);
    public function storeParameters(array $parameters);
    public function getParameterFromStorage($name);
    public function destroy();
}
