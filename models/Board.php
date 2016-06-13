<?php
/**
 * Description of Board
 
 * @author boneff
 */
class Board {
    private $width;
    private $height;
    private $xAxisLabelType;
    private $yAxisLabelType;
    private $boardPositions = [];
    private $boardShips = [];
    
    /**
     * 
     * @param array $config
     * 
     */
    public function __construct(Config $config) {
        $this->width = $config->getBoardSize();
        $this->height = $config->getBoardSize();
        $this->xAxisLabelType = $config->getBoardXLabelType();
        $this->yAxisLabelType = $config->getBoardXLabelType();
    }
    
    public function getWidth() {
        return $this->width;
    }

    public function getHeight() {
        return $this->height;
    }

    public function getXAxisLabelType() {
        return $this->xAxisLabelType;
    }

    public function getYAxisLabelType() {
        return $this->yAxisLabelType;
    }

            
    public function getBoardPositions() {
        return $this->boardPositions;
    }   
    
    public function getBoardShips() {
        return $this->boardShips;
    }
    
    public function setBoardPosition(BoardPosition $boardPosition) {
        $this->boardPositions[$boardPosition->getCoordinateX()][$boardPosition->getCoordinateY()] = $boardPosition;
    }
    
    /**
     * 
     * @param int $coordinateX
     * @param int $coordinateY
     * @return type
     * 
     */
    public function getBoardPosition($coordinateX, $coordinateY) {
        return $this->boardPositions[$coordinateX][$coordinateY];
    }
    
    public function addBoardShip(Ship $boardShip) {
        $this->boardShips[] = $boardShip;
    }
}
