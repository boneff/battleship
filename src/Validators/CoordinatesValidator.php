<?php

namespace Battleships\Validators;

use Battleships\Helpers\BoardHelper;
use Battleships\Validators\ValidatorInterface;

class CoordinatesValidator implements ValidatorInterface
{
    private $errors;

    public function __construct()
    {
        $this->errors = [];
    }

    /**
     * @param $input
     * @return bool
     */
    public function validate($input)
    {
        // if submitted a request for a hint - coordinates are ok
        if (isset($input) && $input == 'show') {
            return true;
        }

        if (isset($input) && strlen($input) < 2) {
            $this->addError('Coordinate length not enough. Please set valid coordinates! For example A3!');
            return false;
        }

        if (isset($input) && empty(BoardHelper::getCoordinatesInRange($input))) {
            $this->addError('Please set valid coordinates! For example A3!');
            return false;
        }

        return true;
    }

    private function addError($error)
    {
        array_push($this->errors, $error);
    }
}
