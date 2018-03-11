<?php

namespace Battleships\Models;

/**
 * Description of BoardPosition
 *
 * @author boneff
 */
class BoardPosition
{
    const FREE = 1;
    const OCCUPPIED = 2;
    
    private $coordinateX;
    private $coordinateY;
    private $isClicked = false;
    private $status = self::FREE;
    
    /**
     *
     * @param int $coordinateX
     * @param int $coordinateY
     */
    public function __construct($coordinateX, $coordinateY)
    {
        $this->coordinateX = $coordinateX;
        $this->coordinateY = $coordinateY;
    }

    /**
     * @return bool
     */
    public function getIsClicked()
    {
        return $this->isClicked;
    }

    /**
     * @return int
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $isClicked
     */
    public function setIsClicked($isClicked)
    {
        $this->isClicked = $isClicked;
    }

    public function setStatus($status)
    {
        $this->status = $status;
    }
    
    public function getCoordinateX()
    {
        return $this->coordinateX;
    }

    public function getCoordinateY()
    {
        return $this->coordinateY;
    }
}
