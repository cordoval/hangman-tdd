<?php

namespace Qandidate\Tests;

use Qandidate\Api;

class MoreSpecs extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_throws_an_exception_when_passed_invalid_character_on_input()
    {
        $this->setExpectedException('InvalidArgumentException', 'Please provide input with pattern a-z');
        $game = Api::bootGame();
        $game->guessCharacter('1');
    }
}