<?php

namespace Battleships\Models;

use Battleships\Config\Config;
use Battleships\Models\BoardPosition;
use Battleships\Models\Ship;

class Board
{
    private $width;
    private $height;
    private $xAxisLabelType;
    private $yAxisLabelType;
    private $boardPositions = [];
    private $boardShips = [];

    /**
     * Board constructor.
     * @param Config $config
     */
    public function __construct(Config $config)
    {
        $this->width = $config->getBoardSize();
        $this->height = $config->getBoardSize();
        $this->xAxisLabelType = $config->getBoardXLabelType();
        $this->yAxisLabelType = $config->getBoardXLabelType();
    }
    
    public function getWidth()
    {
        return $this->width;
    }

    public function getHeight()
    {
        return $this->height;
    }

    public function getXAxisLabelType()
    {
        return $this->xAxisLabelType;
    }

    public function getYAxisLabelType()
    {
        return $this->yAxisLabelType;
    }

            
    public function getBoardPositions()
    {
        return $this->boardPositions;
    }
    
    public function getBoardShips()
    {
        return $this->boardShips;
    }
    
    public function setBoardPosition(BoardPosition $boardPosition)
    {
        $this->boardPositions[$boardPosition->getCoordinateX()][$boardPosition->getCoordinateY()] = $boardPosition;
    }
    
    /**
     *
     * @param int $coordinateX
     * @param int $coordinateY
     * @return BoardPosition
     *
     */
    public function getBoardPosition($coordinateX, $coordinateY)
    {
        return $this->boardPositions[$coordinateX][$coordinateY];
    }

    public function removeBoardShip($index)
    {
        if (array_key_exists($index, $this->boardShips)) {
            unset($this->boardShips[$index]);
        }
    }
    
    public function addBoardShip(Ship $boardShip)
    {
        $this->boardShips[] = $boardShip;
    }


    public function setBoardShips(array $ships)
    {
        foreach ($ships as $ship) {
            if ($ship instanceof Ship) {
                $this->boardShips[] = $ship;
            }
        }
    }


    public function findFreeStartingPosition()
    {
        $startCoordinateX = rand(0, $this->getWidth() -1);
        $startCoordinateY = rand(0, $this->getHeight() -1);

        /** @var $boardPosition BoardPosition */
        $boardPosition = $this->getBoardPosition($startCoordinateX, $startCoordinateY);
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
