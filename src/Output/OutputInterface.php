<?php

namespace Battleships\Output;

interface OutputInterface
{
    public function getView();
    public function getOutput();
    public function appendToOutput(string $data);
}
