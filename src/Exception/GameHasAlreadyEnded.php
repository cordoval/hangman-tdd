<?php

namespace Qandidate\Exception;

class GameHasAlreadyEnded extends \Exception
{
    public function __construct()
    {
        parent::__construct(
            'You cannot keep playing a game that has already ended.'
        );
    }
}
