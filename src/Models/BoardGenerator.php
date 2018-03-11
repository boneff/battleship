<?php

namespace Battleships\Models;

use Battleships\Config\Config;

/**
 * Description of BoardGenerator
 *
 * @author boneff
 * @parameters array $config
 * @return Board $board
 */
class BoardGenerator
{
    /**
     * @var Board
     */
    private $board;
    /**
     *
     * @var array
     */
    private $config;
    private $boardWidth;
    private $boardHeight;

    /**
     * BoardGenerator constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->config = $config;
        $this->boardWidth = $this->config->getBoardSize();
        $this->boardHeight = $this->config->getBoardSize();
    }

    public function generateBoard()
    {
        $this->board = new Board($this->config);

        $this->generateBoardPositions();
        $this->generateShips();
        return $this->board;
    }
    
    private function generateBoardPositions()
    {
        for ($i=0; $i < $this->boardWidth; $i ++) {
            for ($j=0; $j < $this->boardHeight; $j ++) {
                $boardPosition = new BoardPosition($i, $j);
                $this->board->setBoardPosition($boardPosition);
            }
        }
    }
    
    private function generateShips()
    {
        foreach ($this->config->getShips() as $shipConfig) {
            while ($shipConfig['count'] > 0) {
                $ship = new Ship($shipConfig['type'], $shipConfig['size']);
                $this->generateShipCoordinates($ship);
                $shipConfig['count'] --;
                $this->board->addBoardShip($ship);
            }
        }
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
        $arrStartingCoordinates = $this->findFreeStartingPosition();
        
        if ($ship->getOrientation() == Ship::HORIZONTAL_ORIENTATION) {
            $direction = ($arrStartingCoordinates['x'] > $this->boardWidth/2) ? 'left' : 'right';
        } else {
            $direction = ($arrStartingCoordinates['y'] > $this->boardHeight/2) ? 'top' : 'bottom';
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
 
    private function findFreeStartingPosition()
    {
        $startCoordinateX = rand(0, $this->boardWidth -1);
        $startCoordinateY = rand(0, $this->boardHeight -1);
        
        $boardPosition = $this->board->getBoardPosition($startCoordinateX, $startCoordinateY);
        if ($boardPosition->getStatus() == BoardPosition::FREE) {
            return [
                'x' => $startCoordinateX,
                'y' => $startCoordinateY,
            ];
        } else {
            return $this->findFreeStartingPosition();
        }
    }
}
