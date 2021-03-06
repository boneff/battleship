<?php

namespace Battleships\Config;

class Config
{
    private static $instance = null;

    private $applicationName = 'Battleships';
    private $boardXLabelType = 'letters';
    private $boardYLabelType = 'numbers';
    private $boardSize       = 10;
    private $ships = [
        [
            'type' => 'battleship',
            'count' => 1,
            'size' => 5
        ],
        [
            'type' => 'destroyer',
            'count' => 2,
            'size' => 4
        ]
    ];
    /**
     *
     * @return self
     */
    public static function instance()
    {
        if (self::$instance === null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct()
    {
    }

    /**
     * @return string
     */
    public function getBoardXLabelType()
    {
        return $this->boardXLabelType;
    }

    /**
     * @return string
     */
    public function getApplicationName()
    {
        return $this->applicationName;
    }

    /**
     * @return string
     */
    public function getBoardYLabelType()
    {
        return $this->boardYLabelType;
    }

    /**
     * @return int
     */
    public function getBoardSize()
    {
        return $this->boardSize;
    }

    /**
     * @return array
     */
    public function getShips()
    {
        return $this->ships;
    }
}
