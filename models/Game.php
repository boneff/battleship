<?php

/**
 * Description of Game
 *
 * @author boneff
 */
class Game {
    const IDLE = 0;
    const RUNNING = 1;
    const FINISHED = 2;
    
    private $moves;
    private $state;
    
    public function __construct() {
        $this->moves = 0;
        $this->state = self::IDLE;
    }
    
    public function getMoves() {
        return $this->moves;
    }

    public function getState() {
        return $this->state;
    }

    public function incrementMoves() {
        $this->moves += 1;
    }

    public function setMoves($moves) {
        $this->moves = $moves;
    }

    public function setState($state) {
        $this->state = $state;
    }

}
