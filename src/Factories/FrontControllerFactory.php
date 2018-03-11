<?php

namespace Battleships\Factories;

use Battleships\Controllers\FrontController;

class FrontControllerFactory
{
    public static function init(string $clientMode)
    {
        if ($clientMode == "cli") {
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

        return new FrontController($options);
    }
}
