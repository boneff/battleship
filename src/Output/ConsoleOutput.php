<?php

namespace Battleships\Output;

class ConsoleOutput implements OutputInterface
{
    private $view;
    private $output;

    public function __construct()
    {
        $this->view =  __DIR__ . '/../../templates/consoleView.php';
        $this->output = '';
    }

    /**
     * @return string
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @return string
     */
    public function getOutput()
    {
        return $this->output;
    }

    public function appendToOutput(string $data)
    {
        $this->output .= $data;
    }
}
