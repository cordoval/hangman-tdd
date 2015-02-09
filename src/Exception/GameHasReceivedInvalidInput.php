<?php

namespace Qandidate\Exception;

class GameHasReceivedInvalidInput extends GameException
{
    public function __construct()
    {
        parent::__construct(
            'The character you have guessed is invalid. Please try a-z.'
        );
    }
}
