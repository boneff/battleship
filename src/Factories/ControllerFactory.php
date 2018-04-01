<?php

namespace Battleships\Factories;

use Battleships\Config\Config;
use Battleships\Controllers\BoardController;
use Battleships\Controllers\WebController;
use Battleships\Controllers\ConsoleController;
use Battleships\Input\ConsoleInput;
use Battleships\Input\WebInput;
use Battleships\Models\Game;
use Battleships\Output\ConsoleOutput;
use Battleships\Output\WebOutput;
use Battleships\Services\BoardManager;
use Battleships\Storage\ConsoleStorage;
use Battleships\Storage\SessionStorage;
use Battleships\Validators\CoordinatesValidator;

class ControllerFactory
{
    public static function make(string $clientMode) : BoardController
    {
        $validator = new CoordinatesValidator();
        $game = new Game();
        $boardFactory = new BoardFactory(Config::instance());
        $board = $boardFactory->make();

        if ($clientMode == "cli") {
            $storage = new ConsoleStorage();
            $input = new ConsoleInput();
            $output = new ConsoleOutput();
            $boardManager = new BoardManager($board, $game, $storage);

            $controller = new ConsoleController($validator, $input, $output, $boardManager);
        } else {
            session_start();

            $storage = new SessionStorage();
            $input = new WebInput();
            $output = new WebOutput();
            $boardManager = new BoardManager($board, $game, $storage);

            $controller = new BoardController($validator, $input, $output, $boardManager);
        }

        return $controller;
    }
}
