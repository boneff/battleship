<?php

/**
 * Description of ConsoleController
 *
 * @author boneff
 */
class ConsoleController extends BoardController {

    public function index() {
        $output = $this->output;
        require_once 'templates/consoleView.php';
    }
}
