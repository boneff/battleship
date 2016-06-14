<?php
/**
 * Created by PhpStorm.
 * User: boneff
 * Date: 14.6.2016 г.
 * Time: 10:07
 */

interface Storage {
    public function storeParameter($paramName, $paramValue);
    public function storeParameters(array $parameters);
    public function getParameterFromStorage($name);
    public function destroy();
}