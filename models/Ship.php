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
    private $hits;
    private $coordinates;
    
    /**
     * 
     * @param string $type
     * @param int $size
     */
    public function __construct($type, $size) {
        $this->size = $size;
        $this->hits = 0;
        $this->type = $type;
        $this->orientation = rand(1,2);
        $this->isSunk = false;
    }
    
    public function getIsSunk() {
        return $this->isSunk;
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

    function checkIsHit($x, $y) {
        $isHit = array_search([$x, $y], $this->coordinates);
        if ($isHit !== false) {
            $this->hits += 1;
            unset($this->coordinate[$isHit]);
            $this->isSunk = ($this->hits === $this->size) ? true : false;
        }
        return $isHit;
    }

    public function addBoardPositionCoordinate(BoardPosition $position) {
        $this->coordinates[] = [$position->getCoordinateX(), $position->getCoordinateY()];
    }
}
