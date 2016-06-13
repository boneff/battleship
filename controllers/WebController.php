<?php

/**
 * Description of WebController
 *
 * @author boneff
 */
class WebController extends BoardController {

    public function index() {
        session_start();
        if (!isset($_SESSION['board'])) {
            $boardGenerator = new BoardGenerator(Config::instance());
            $this->board = $boardGenerator->generateBoard();
            $_SESSION['board'] = $this->board;
        }

        $this->board = $_SESSION['board'] ;
        $arrAxisLabels = $this->generateBoardLabels();
        $coordinates = isset($_REQUEST['coordinates']) ? $_REQUEST['coordinates'] : [];

        if(count($coordinates) > 0) {
            $keyX = array_search($coordinates[0], $arrAxisLabels['x']);
            $keyY = array_search($coordinates[1], $arrAxisLabels['y']);
            var_dump($keyY, $keyX);
            if ($keyX != false && $keyY != false) {
                $this->openPosition($keyX, $keyY);
            }
        }

        $_SESSION['board'] = $this->drawBoard();
        $output = $_SESSION['board'];
        require_once '/templates/webView.php';
    }
}
