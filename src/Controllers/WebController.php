<?php

namespace Battleships\Controllers;

use Battleships\Storage\SessionStorage;

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

    public function __construct()
    {
        parent::__construct();
        $this->storage = new SessionStorage();
        $this->coordinates = isset($_REQUEST['coordinates']) ? $_REQUEST['coordinates'] : '';
        $this->view = __DIR__ . '/../../templates/webView.php';
    }

    public function index()
    {
        parent::index();

        if (count($this->board->getBoardShips()) > 0) {
            $output = $this->output;
            require_once $this->view;
        } else {
            $output = $this->game->getMoves();
            require_once __DIR__ . '/../../templates/webFinish.php';
            $this->storage->destroy();
        }
    }
}
