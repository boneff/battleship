<?php

namespace Battleships\Controllers;

use Battleships\Helpers\BoardHelper;
use Battleships\Input\InputInterface;
use Battleships\Models\BoardMessage;
use Battleships\Output\OutputInterface;
use Battleships\Services\BoardManager;
use Battleships\Validators\ValidatorInterface;

class BoardController
{
    protected $output;
    protected $input;

    /**
     * @var BoardManager
     */
    protected $boardManager;
    protected $validator;

    public function __construct(
        ValidatorInterface $validator,
        InputInterface $input,
        OutputInterface $output,
        BoardManager $boardManager
    ) {
        $this->validator = $validator;
        $this->output = $output;
        $this->input = $input;
        $this->boardManager = $boardManager;
    }

    public function index()
    {
        $this->boardManager->init();
        $isHit = null;
        $input = $this->input->getInput('coordinates');
        $hint = false;
        $this->output->appendToOutput(BoardMessage::NONE);

        if ($this->validator->validate($input)) {
            $hint = ($input == "show") ? true : false;
            if ($hint == false && !empty($input)) {
                $coordinatesInRange = BoardHelper::getCoordinatesInRange($input);
                $boardData = $this->boardManager->updateBoardShips($coordinatesInRange['x'], $coordinatesInRange['y']);

                $this->output->appendToOutput($boardData);
            }
        }

        $this->output->appendToOutput(PHP_EOL . $this->boardManager->drawBoard($hint));

        $this->showView();
    }

    private function showView()
    {
        if (count($this->boardManager->getBoard()->getBoardShips()) > 0) {
            $output = $this->output->getOutput();
            require $this->output->getView();
        } else {
            $output = $this->boardManager->getGame()->getMoves();
            require __DIR__ . '/../../templates/webFinish.php';
            $this->boardManager->getStorage()->destroy();
        }
    }
}
