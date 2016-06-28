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
            $this->coordinates = trim(fgets(STDIN, 1024));
            parent::index();
            if (count($this->board->getBoardShips()) > 0) {
                $output = $this->output;
                $output .= $this->gameInstruction;           
                // use require instead of require once, so view is redrawn in console 
                require $this->view;
            } else {
                $output = "Game finished in " . $this->game->getMoves() . " moves!";
                require 'templates/consoleView.php';
                $this->storage->destroy();
            }
        }
    }

}
