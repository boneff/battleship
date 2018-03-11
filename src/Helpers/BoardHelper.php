<?php

namespace Battleships\Helpers;

use Battleships\Config\Config;

class BoardHelper
{
    public static function generateBoardLabels() {
        // return 2 arrays with numbers and letters - used to label the board fields
        // chr(65) - returns uppercase A
        if (Config::instance()->getBoardXLabelType() == 'numbers') {
            $arrXaxis = range(1, Config::instance()->getBoardSize());
            $arrYaxis = range(chr(65), chr(65 + Config::instance()->getBoardSize()));
        } else {
            $arrXaxis = range(chr(65), chr(65 + Config::instance()->getBoardSize()));
            $arrYaxis = range(1, Config::instance()->getBoardSize());
        }

        return [
            'x' => $arrXaxis,
            'y' => $arrYaxis,
        ];
    }

    public static function checkCoordinatesInRange($coordinates) {
        $arrAxisLabels = self::generateBoardLabels();

        $x = strtoupper($coordinates[0]);
        $y = (strlen($coordinates) == 3) ? $coordinates[1] . $coordinates[2] : $coordinates[1];
        $keyX = array_search($x, $arrAxisLabels['x']);
        $keyY = array_search($y, $arrAxisLabels['y']);

        return ($keyX !== false && $keyY !== false) ? ['x' => $keyX, 'y' => $keyY ] : false;
    }
}