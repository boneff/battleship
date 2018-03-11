<?php

namespace Battleships\Controllers;

use Battleships\Storage\ConsoleStorage;

class ConsoleController extends BoardController
{
    protected $storage;
    protected $output;
    protected $coordinates;
    protected $view;

    function __construct() {
        $this->storage = new ConsoleStorage();
        $this->output = '';
        $this->coordinates = '';
        $this->view = __DIR__ . '/../../templates/consoleView.php';
    }

    public function index() {
        parent::init();
        parent::index();
        $this->output .= $this->gameInstruction . ' ' . PHP_EOL;
        $this->showView($this->output);
        
        while (($this->board->getBoardShips()) > 0) {
            // get coordinates from console input
            $this->coordinates = trim(fgets(STDIN, 1024));
            // get them processed in parent index method
            parent::index();
            // check whether all ships are sunk and display board if not
            // else display the end of the game 
            if (count($this->board->getBoardShips()) > 0) {
                $this->output .= $this->gameInstruction . ' ' . PHP_EOL;
                $this->showView($this->output);
            } else {
                $this->output = 'Game finished in ' . $this->game->getMoves() . ' moves! ' . PHP_EOL;
                $this->showView($this->output);
                // empty storage and stop script
                $this->storage->destroy();
                exit;
            }
        }
    }
    
    /**
     * Send data to view and show it
     * 
     * @param type $data
     */
    private function showView($data) {
        // assign data to a local variable used in the view
        $output = $data;
        // use require instead of require once, so view is redrawn in console 
        require $this->view;
    }

}
