<?php

class BoardController {
    protected $storage;
    protected $output;
    protected $coordinates;
    protected $view;
    protected $board;
    protected $boardManager;
    protected $game;

    function __construct() {
        $this->storage = new SessionStorage();
        $this->output = '';
        $this->coordinates = isset($_REQUEST['coordinates']) ? $_REQUEST['coordinates'] : '';
        $this->view = 'templates/webView.php';
    }

    public function init() {
        if($this->storage->getParameterFromStorage('board') == false) {
            $boardGenerator = new BoardGenerator(Config::instance());

            $this->board = $boardGenerator->generateBoard();
            $this->boardManager = new BoardManager($this->board);
            $this->game = new Game();

            $this->storage->storeParameters([
                'board' => $this->board,
                'boardManager' => $this->boardManager,
                'game'  => $this->game,
            ]);
        } else {
            $this->board = $this->storage->getParameterFromStorage('board');
            $this->boardManager = $this->storage->getParameterFromStorage('boardManager');
            $this->game = $this->storage->getParameterFromStorage('game');
        }
    }

    public function index() {
        $this->init();
        $isHit = NULL;
        // check user input
        $coordinates = $this->coordinates;
        $hint = ($coordinates == "show") ? true : false;

        if (strlen($coordinates) >= 2) {
            $coordinatesInRange = Helper::checkCoordinatesInRange($coordinates);

            if ($coordinatesInRange !== false) {
                $isHit = $this->boardManager->openPosition($coordinatesInRange['x'], $coordinatesInRange['y']);
                $this->game->incrementMoves();
            } else {
                $this->output = ($coordinates != "show") ? BoardMessage::ERROR : '';
            }
        }

        switch ($isHit) {
            case BoardPosition::FREE :
                $this->output .= BoardMessage::MISS;
                break;
            case BoardPosition::OCCUPPIED :
                foreach ($this->board->getBoardShips() as $key => $ship) {
                    /**
                     * @var Ship $ship
                     */
                    if ($ship->checkIsHit($coordinatesInRange['x'], $coordinatesInRange['y']) !== false) {
                        if ($ship->getIsSunk() == true) {
                            $this->output .= BoardMessage::SUNK;
                            $this->board->removeBoardShip($key);
                        } else {
                            $this->output .= BoardMessage::HIT;
                        }
                        break 2;
                    }
                }
                break;
            default:
                $this->output .= BoardMessage::NONE;
        }

        // store all objects in Session again, once finished manipulating them
        $this->storage->storeParameters([
            'board' => $this->board,
            'boardManager' => $this->boardManager,
            'game' => $this->game,
        ]);
        $this->output .= PHP_EOL . $this->boardManager->drawBoard($hint);


    }

    protected function displayView($view) {
        require_once $view;
    }
}