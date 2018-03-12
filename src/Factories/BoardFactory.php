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
    public static function init(Config $config)
    {
        $boardGenerator = new BoardGenerator($config);
        $board = $boardGenerator->generateBoard();

        $shipGenerator = new ShipGenerator($config, $board);
        $ships = $shipGenerator->generateShips();

        $board->setBoardShips($ships);

        return $board;
    }
}
