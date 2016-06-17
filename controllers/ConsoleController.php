<?php

/**
 * Description of ConsoleController
 *
 * @author boneff
 */
class ConsoleController extends BoardController {

    protected $storage;
    protected $output;
    protected $coordinates;
    protected $view;

    function __construct() {
        $this->storage = new ConsoleStorage();
        $this->output = '';
        $this->coordinates = trim(fgets(STDIN, 1024));
        $this->view = 'templates/consoleView.php';
    }

    public function index() {
        parent::init();
        
        while (($this->board->getBoardShips()) > 0) {
            parent::index();
            if (count($this->board->getBoardShips()) > 0) {
                $output = $this->output;
                $output .= $this->gameInstruction;
                require_once $this->view;
            } else {
                $output = $this->game->getMoves();
                require_once 'templates/consoleView.php';
                $this->storage->destroy();
            }
        }
    }

}
