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
        $this->coordinates = getopt('c:') != false  ? getopt('c:') : '';
        $this->view = 'templates/webView.php';
    }

    public function index() {
        parent::index();

        if (count($this->board->getBoardShips()) > 0) {
            $output = $this->output;
            require_once $this->view;
        } else {
            $output = $this->game->getMoves();
            require_once 'templates/webFinish.php';
            $this->storage->destroy();
        }
    }

}
