<?php

namespace Battleships\Models;

/**
 * Description of Game
 *
 * @author boneff
 */
class Game
{
    const IDLE = 0;
    const RUNNING = 1;
    const FINISHED = 2;
    
    private $moves;
    private $state;
    private $gameExplanation;
    
    public function __construct() {
        $this->moves = 0;
        $this->state = self::IDLE;
        $this->gameExplanation = 'Enter coordinates (row, col), e.g. A5';
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
    
    function getGameExplanation() {
        return $this->gameExplanation;
    }

    function setGameExplanation($gameExplanation) {
        $this->gameExplanation = $gameExplanation;
    }

}
