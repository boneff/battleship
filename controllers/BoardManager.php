<?php

/**
 * Description of BoardController
 *
 * @author boneff
 */
class BoardManager {
    /**
     *
     * @var Board 
     */
    private $board;
    
    public function __construct(Board $board) {
        $this->board = $board;
    }  
    
    public function getBoard() {
        return $this->board;
    }

    public function drawBoard($showHint = false) {
        $arrAxisLabels = $this->generateBoardLabels();
        $output = '  ' . implode(' ', $arrAxisLabels['y']) .  PHP_EOL;

        for ($i = 0; $i < $this->board->getWidth(); $i ++) {
            $output .=  $arrAxisLabels['x'][$i] . ' ';
            for($j = 0; $j < $this->board->getHeight(); $j ++) {
                $newRow = ($j == $this->board->getWidth() - 1) ? PHP_EOL : ' ';
                $boardPosition = $this->board->getBoardPosition($i, $j);
                if ($showHint == true) {
                    $output .= ($boardPosition->getStatus() == BoardPosition::FREE) ? ' ' : 'x';
                } else {
                    $output .= (($boardPosition->getStatus() == BoardPosition::FREE && $boardPosition->getIsClicked() == true)) ? '-' : '';
                    $output .= (($boardPosition->getStatus() == BoardPosition::OCCUPPIED && $boardPosition->getIsClicked() == true)) ? 'x' : '';
                    $output .= ($boardPosition->getIsClicked() == false) ? '.' : '';
                }
                
                $output .= $newRow;
            }
        }
        $this->output = $output;
        return $this->output;
    }

    /**
     * @param int x
     * @param int y
     */
    public function openPosition($x, $y) {
        /**
         * @var BoardPosition $boardPosition
         */
        $boardPosition = $this->board->getBoardPosition($x, $y);
        $boardPosition->setIsClicked(true);
        $this->board->setBoardPosition($boardPosition);
        
        return $boardPosition->getStatus();
    }

    public function generateBoardLabels() {
        // return 2 arrays with numbers and letters - used to label the board fields
        // chr(65) - returns uppercase A     
        if (Config::instance()->getBoardXLabelType() == 'numbers') {
            $arrXaxis = range(1, Config::instance()->getBoardSize());
            $arrYaxis = range(chr(65), chr(65 + Config::instance()->getBoardSize()));
        } else {
            $arrXaxis = range(chr(65), chr(65 + Config::instance()->getBoardSize()));
            $arrYaxis = range(1, Config::instance()->getBoardSize());
        }
        
        return [
            'x' => $arrXaxis,
            'y' => $arrYaxis,
        ];
    }
}
