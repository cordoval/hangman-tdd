<?php

namespace Qandidate\Tests\Api;

use Qandidate\Api;
use Qandidate\Exception\GameHasAlreadyEnded;

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

    /** @test */
    public function it_ends_the_game_failing_when_one_letter_is_missing_and_letter_guessed_is_not_correct()
    {
        $game = Api::bootGame();
        $this->assertEquals('someword', $game->getWord());
        foreach (str_split('abcfghijkl') as $character) {
            $game->guessCharacter($character);
        }
        $this->assertEquals(1, $game->getTriesLeft());
        $this->assertEquals(Api::GAME_BUSY, $game->getStatus());

        $game->guessCharacter('n');
        $this->assertEquals(Api::GAME_FAIL, $game->getStatus());
    }

    /** @test */
    public function it_does_not_allow_to_keep_guessing_after_game_has_been_won()
    {
        $game = Api::bootGame('so');
        $game->guessCharacter('s');
        $game->guessCharacter('o');
        $this->assertEquals(Api::GAME_SUCCESS, $game->getStatus());

        $this->setExpectedException(GameHasAlreadyEnded::class);
        $game->guessCharacter('x');
    }

    /** @test */
    public function it_does_not_allow_to_keep_guessing_after_game_has_been_lost()
    {
        $game = Api::bootGame('so');
        foreach (str_split('abcfghijklm') as $character) {
            $game->guessCharacter($character);
        }
        $this->assertEquals(Api::GAME_FAIL, $game->getStatus());

        $this->setExpectedException(GameHasAlreadyEnded::class);
        $game->guessCharacter('x');
    }
}
