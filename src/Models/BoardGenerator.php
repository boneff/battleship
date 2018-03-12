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
}
