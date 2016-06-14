<?php

/**
 * Description of WebController
 *
 * @author boneff
 */
class WebController {
    
    public function init() {
        echo !isset($_SESSION['board']);
        if(!isset($_SESSION['board'])) {
            $boardGenerator = new BoardGenerator(Config::instance());
            $this->board = $boardGenerator->generateBoard();
            $this->boardManager = new BoardManager($this->board);
            $this->game = new Game();
            $_SESSION['board'] = $this->board;
            $_SESSION['game'] = $this->game;
        } else {
            $this->board = $_SESSION['board'];
            $this->boardManager = new BoardManager($this->board);
            $this->game = $_SESSION['game'];
        }  
    }

    public function index() {
        $this->init();
        $isHit = '';
        $hint = false;
        $arrAxisLabels = $this->boardManager->generateBoardLabels();
        
        $coordinates = isset($_REQUEST['coordinates']) ? $_REQUEST['coordinates'] : '';
        if(strlen($coordinates) > 2) {
            $x = strtoupper($coordinates[0]);
            $y = (strlen($coordinates) == 3) ? $coordinates[1] . $coordinates[2] : $coordinates[1];
            $keyX = array_search($x, $arrAxisLabels['x']);
            $keyY = array_search($y, $arrAxisLabels['y']);
            echo 'boom ' . $keyX . ' ' . $keyY . ' ' . ($keyX !== false && $keyY !== false);
            if ($keyX !== false && $keyY !== false) {
               $isHit = $this->boardManager->openPosition($keyX, $keyY);
               $_SESSION['board'] = $this->boardManager->getBoard();
               $this->game->set
            } else {
                $output = BoardMessage::ERROR;
            }
        }
        if ($coordinates == "show") {
            $hint = true;
        }
        
        switch ($isHit) {
            case (isset($isHit) && $isHit == BoardPosition::FREE) :
                $output = BoardMessage::MISS;
                break;
            case (isset($isHit) && $isHit == BoardPosition::OCCUPPIED) :
                $output = BoardMessage::HIT;
                break;
            default: 
                $output = BoardMessage::NONE;
        }
        
        $output .= PHP_EOL . $this->boardManager->drawBoard($hint);
        require_once 'templates/webView.php';
    }
}
