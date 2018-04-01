<?php

namespace Battleships\Output;

class WebOutput implements OutputInterface
{
    private $view;
    private $output;

    public function __construct()
    {
        $this->view =  __DIR__ . '/../../templates/webView.php';
        $this->output = '';
    }

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
