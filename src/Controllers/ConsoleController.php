<?php

namespace Battleships\Controllers;

class ConsoleController extends BoardController
{
    public function index()
    {
        while (($this->boardManager->getBoard()->getBoardShips()) > 0) {
            parent::index();
        }
    }
}
