<?php

/**
 * Description of WebController
 *
 * @author boneff
 */
class WebController extends BoardController {
    
    public function __construct() {
        $boardGenerator = new BoardGenerator(Config::instance());
        $this->board = $boardGenerator->generateBoard();
        $this->game = new Game();
    }

    public function index() {
        $isHit = '';
        $arrAxisLabels = $this->generateBoardLabels();
        $coordinates = isset($_REQUEST['coordinates']) ? $_REQUEST['coordinates'] : [];
            
        if(count($coordinates) == 2) {
            $keyX = array_search($coordinates[0], $arrAxisLabels['x']);
            $keyY = array_search($coordinates[1], $arrAxisLabels['y']);
            if ($keyX != false && $keyY != false) {
               $isHit = $this->openPosition($keyX, $keyY);
            }
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
        
        $output .= PHP_EOL . $this->drawBoard(true);
        require_once 'templates/webView.php';
    }
}
