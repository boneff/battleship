<?php
/**
 * Description of Ship 
 *
 * @author boneff
 */
class Ship {
    const VERTICAL_ORIENTATION = 1;
    const HORIZONTAL_ORIENTATION = 2;
    
    private $size;
    private $type;
    private $orientation;
    private $isSunk;
    private $coordinates;
    
    /**
     * 
     * @param string $type
     * @param int $size
     */
    public function __construct($type, $size) {
        $this->size = $size;
        $this->type = $type;
        $this->orientation = rand(1,2);
        $this->isSunk = false;
    }
    
    public function getIsSunk() {
        return $this->isSunk;
    }

    public function setIsSunk($isSunk) {
        $this->isSunk = $isSunk;
    }
    
    public function getOrientation() {
        return $this->orientation;
    }

    public function setOrientation($orientation) {
        $this->orientation = $orientation;
    }

    public function getSize() {
        return $this->size;
    }

    public function getType() {
        return $this->type;
    }

    public function getCoordinates() {
        return $this->coordinates;
    }

    public function setCoordinates($arrBoardPositions) {
        $this->coordinates = $arrBoardPositions;
    }
    
    public function addCoordinate(BoardPosition $position) {
        $this->coordinates[] = $position;
    }



}
