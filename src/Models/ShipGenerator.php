<?php
/**
 * Created by PhpStorm.
 * User: boneff
 * Date: 3/12/18
 * Time: 1:28 AM
 */

namespace Battleships\Models;

use Battleships\Config\Config;

class ShipGenerator
{
    private $board;
    private $config;

    public function __construct(Config $config, Board $board)
    {
        $this->board = $board;
        $this->config = $config;
    }

    public function generateShips()
    {
        $ships = [];

        foreach ($this->config->getShips() as $shipConfig) {
            while ($shipConfig['count'] > 0) {
                $ship = new Ship($shipConfig['type'], $shipConfig['size']);
                $this->generateShipCoordinates($ship);
                $shipConfig['count'] --;
                $ships[] = $ship;
            }
        }

        return $ships;
    }
    /**
     * Finds free coordinates and addes them to current ship instance
     *
     * @param Ship $ship
     * @return type
     */
    private function generateShipCoordinates($ship)
    {
        $freePositions = [];
        /**
         * @var Ship $ship
         */
        $shipSize = $ship->getSize();
        $arrStartingCoordinates = $this->board->findFreeStartingPosition();

        if ($ship->getOrientation() == Ship::HORIZONTAL_ORIENTATION) {
            $direction = ($arrStartingCoordinates['x'] > $this->board->getWidth()/2) ? 'left' : 'right';
        } else {
            $direction = ($arrStartingCoordinates['y'] > $this->board->getHeight()/2) ? 'top' : 'bottom';
        }

        switch ($direction) {
            case 'left':
                $startCoordinate = $arrStartingCoordinates['x'] - $shipSize;
                $endCoordinate = $arrStartingCoordinates['x'];
                break;
            case 'right':
                $startCoordinate = $arrStartingCoordinates['x'];
                $endCoordinate = $arrStartingCoordinates['x'] + $shipSize;
                break;
            case 'top':
                $startCoordinate = $arrStartingCoordinates['y'];
                $endCoordinate = $arrStartingCoordinates['y'] - $shipSize;
                break;
            case 'bottom':
                $startCoordinate = $arrStartingCoordinates['y'];
                $endCoordinate = $arrStartingCoordinates['y'] + $shipSize;
                break;
        }

        // depending on orientation check for nearest free positions
        if ($ship->getOrientation() == Ship::HORIZONTAL_ORIENTATION) {
            for ($i = $startCoordinate; $i < $endCoordinate; $i ++) {
                $boardPosition = $this->board->getBoardPosition($i, $arrStartingCoordinates['y']);
                if ($boardPosition->getStatus() == BoardPosition::FREE) {
                    $freePositions[] = $boardPosition;
                }
            }
        } else {
            for ($i = $startCoordinate; $i < $endCoordinate; $i ++) {
                $boardPosition = $this->board->getBoardPosition($arrStartingCoordinates['x'], $i);
                if ($boardPosition->getStatus() == BoardPosition::FREE) {
                    $freePositions[] = $boardPosition;
                }
            }
        }
        // if positions found for the whole ship - add coordinates to ship object
        if (count($freePositions) == $shipSize) {
            foreach ($freePositions as $boardPosition) {
                $boardPosition->setStatus(BoardPosition::OCCUPPIED);
                $ship->addBoardPositionCoordinate($boardPosition);
            }
        } else {
            return $this->generateShipCoordinates($ship);
        }
    }
}
