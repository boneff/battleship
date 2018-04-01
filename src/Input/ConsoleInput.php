<?php

namespace Battleships\Input;

class ConsoleInput implements InputInterface
{
    private $input;

    public function getInput($name = null)
    {
        $this->input = trim(fgets(STDIN, 1024));
        return $this->input;
    }
}
