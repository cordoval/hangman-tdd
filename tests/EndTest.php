<?php

namespace Qandidate\Tests;

use Qandidate\Api;

class EndTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_ends_the_game_when_one_letter_is_missing_and_letter_guessed_is_correct()
    {
        $game = Api::bootGame();
        $this->assertEquals('someword', $game->getWord());
        foreach (str_split('somewor') as $character) {
            $game->guessCharacter($character);
        }
        $this->assertEquals(11, $game->getTriesLeft());
        $this->assertEquals(Api::GAME_BUSY, $game->getStatus());
        $this->assertEquals('somewor.', $game->getMask());

        $game->guessCharacter('d');
        $this->assertEquals(Api::GAME_SUCCESS, $game->getStatus());
    }
}