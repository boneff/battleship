<?php

namespace Battleships\Services;

use Battleships\Helpers\BoardHelper;
use Battleships\Models\Board;
use Battleships\Models\BoardMessage;
use Battleships\Models\BoardPosition;
use Battleships\Models\Game;
use Battleships\Storage\StorageInterface;

class BoardManager
{
    /**
     *
     * @var Board
     */
    private $board;
    /**
     * @var Game
     */
    private $game;

    /**
     * @var StorageInterface
     */
    private $storage;

    public function __construct(Board $board, Game $game, StorageInterface $storage)
    {
        $this->board = $board;
        $this->game = $game;
        $this->storage = $storage;
    }

    public function getBoard()
    {
        return $this->board;
    }

    public function init()
    {
        if ($this->storage->getParameterFromStorage('board') == false) {
            $this->storage->storeParameters([
                'board' => $this->board,
                'game'  => $this->game,
            ]);
        } else {
            $this->board = $this->storage->getParameterFromStorage('board');
            $this->game = $this->storage->getParameterFromStorage('game');
        }
    }

    /**
     * Open position on current board and update ships
     *
     * @param $x
     * @param $y
     * @return string
     */
    public function updateBoardShips($x, $y)
    {
        $isHit = $this->openPosition($x, $y);
        $boardMessage = BoardMessage::NONE;
        switch ($isHit) {
            case BoardPosition::FREE:
                $boardMessage = BoardMessage::MISS;
                break;
            case BoardPosition::OCCUPPIED:
                foreach ($this->getBoard()->getBoardShips() as $key => $ship) {
                    /**
                     * @var Ship $ship
                     */
                    if ($ship->checkIsHit($x, $y) !== false) {
                        if ($ship->getIsSunk() == true) {
                            $boardMessage = BoardMessage::SUNK;
                            $this->getBoard()->removeBoardShip($key);
                        } else {
                            $boardMessage = BoardMessage::HIT;
                        }
                        break 2;
                    }
                }
                break;
            default:
                $boardMessage = BoardMessage::NONE;
        }

        // store all objects in Session again, once finished manipulating them
        $this->storage->storeParameters([
            'board' => $this->board,
            'game' => $this->game,
        ]);

        return $boardMessage;
    }
    
    /**
     * Method for drawing the board
     *
     * @param bool $showHint
     * @return type
     */
    public function drawBoard($showHint = false)
    {
        $arrAxisLabels = BoardHelper::generateBoardLabels();
        $output = '  ' . implode(' ', $arrAxisLabels['y']) . PHP_EOL;

        for ($i = 0; $i < $this->board->getWidth(); $i++) {
            $output .= $arrAxisLabels['x'][$i] . ' ';
            for ($j = 0; $j < $this->board->getHeight(); $j++) {
                $newRow = ($j == $this->board->getWidth() - 1) ? PHP_EOL : ' ';
                /** @var $boardPosition BoardPosition */
                $boardPosition = $this->board->getBoardPosition($i, $j);
                $output .= $this->getBoardContentByPosition($boardPosition, $showHint);
                $output .= $newRow;
            }
        }

        return $output;
    }

    /**
     * Open position on current board
     *
     * @param $x
     * @param $y
     * @return int
     */
    private function openPosition($x, $y)
    {
        /**
         * @var BoardPosition $boardPosition
         */
        $boardPosition = $this->board->getBoardPosition($x, $y);
        $boardPosition->setIsClicked(true);
        $this->board->setBoardPosition($boardPosition);
        $this->game->incrementMoves();

        return $boardPosition->getStatus();
    }

    public function getGame()
    {
        return $this->game;
    }

    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param BoardPosition $boardPosition
     * @param bool $showHint
     * @return string
     */
    private function getBoardContentByPosition(BoardPosition $boardPosition, $showHint = false)
    {
        $output = '';
        if ($showHint == true) {
            $output .= ($boardPosition->getStatus() == BoardPosition::FREE) ? ' ' : 'x';
        } else {
            $output .= (($boardPosition->getStatus() == BoardPosition::FREE
                && $boardPosition->getIsClicked() == true)) ? '-' : '';
            $output .= (($boardPosition->getStatus() == BoardPosition::OCCUPPIED
                && $boardPosition->getIsClicked() == true)) ? 'x' : '';
            $output .= ($boardPosition->getIsClicked() == false) ? '.' : '';
        }

        return $output;
    }
}
