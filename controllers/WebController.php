<?php

/**
 * Description of WebController
 *
 * @author boneff
 */
class WebController extends BoardController
{
    protected $storage;
    protected $output;
    protected $coordinates;
    protected $view;

    function __construct()
    {
        parent::__construct();
        $this->storage = new SessionStorage();
        $this->coordinates = isset($_REQUEST['coordinates']) ? $_REQUEST['coordinates'] : '';
        $this->view = 'templates/webView.php';
    }

    public function index()
    {
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
