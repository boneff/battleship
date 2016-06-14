<?php

/**
 * Description of ConsoleController
 *
 * @author boneff
 */
class ConsoleController {

    public function index() {
        $coordinates = getopt('c:') != false  ? getopt('c:') : [];
        $output = $this->output;
        require_once 'templates/consoleView.php';
    }
}
