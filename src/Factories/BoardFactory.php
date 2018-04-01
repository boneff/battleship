<?php

namespace Battleships\Factories;

use Battleships\Config\Config;
use Battleships\Services\BoardGenerator;
use Battleships\Services\ShipGenerator;

class BoardFactory
{
    private $config;

    /**
     * BoardFactory constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
    }

    /**
     * @return \Battleships\Models\Board
     */
    public function make()
    {
        $boardGenerator = new BoardGenerator($this->config);
        $board = $boardGenerator->generateBoard();

        $shipGenerator = new ShipGenerator($this->config, $board);
        $ships = $shipGenerator->generateShips();

        $board->setBoardShips($ships);

        return $board;
    }
}
