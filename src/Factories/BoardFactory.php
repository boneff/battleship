<?php
/**
 * Created by PhpStorm.
 * User: boneff
 * Date: 3/12/18
 * Time: 1:44 AM
 */

namespace Battleships\Factories;

use Battleships\Config\Config;
use Battleships\Models\BoardGenerator;
use Battleships\Models\ShipGenerator;

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
