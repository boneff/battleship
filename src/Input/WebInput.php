<?php

namespace Battleships\Input;

class WebInput implements InputInterface
{
    private $input;

    public function getInput($name = null)
    {
        $this->input = isset($_REQUEST[$name]) ? $_REQUEST[$name] : '';
        return $this->input;
    }
}
