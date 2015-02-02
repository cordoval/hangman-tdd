<?php

namespace Qandidate\Tests;

use Qandidate\Api;

class StartTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_starts_a_game()
    {
        $game = Api::bootGame();
        $this->assertTrue(is_string((string) $game));
    }

    /** @test */
    public function it_ensures_new_game_displays_dotted_mask()
    {
        $game = Api::bootGame();
        $mask = $game->getMask();
        $this->assertTrue(strlen($mask) > 0 && 1 === preg_match('/^\.*$/', $mask));
    }

    /** @test */
    public function it_initializes_word_and_initial_guess_of_the_same_length()
    {
        $game = Api::bootGame();
        $this->assertEquals(strlen($game->getMask()), strlen($game->getWord()));
    }

    /** @test */
    public function it_starts_with_numbers_of_tries_left_set_to_11()
    {
        $game = Api::bootGame();
        $this->assertEquals(11, $game->getTriesLeft());
    }

    /** @test */
    public function it_fails_one_attempt_and_the_tries_left_gets_decreased()
    {
        $game = Api::bootGame();
        $this->assertEquals(11, $game->getTriesLeft());
        $game->guessCharacter('x');
        $this->assertEquals(10, $game->getTriesLeft());
    }

    /** @test */
    public function it_does_not_decrease_tries_left_when_character_is_correct()
    {
        $game = Api::bootGame();
        $this->assertEquals(11, $game->getTriesLeft());
        $correctWord = $game->getWord();
        $game->guessCharacter($correctWord[0]);
        $this->assertEquals(11, $game->getTriesLeft());
    }

    /** @test */
    public function it_holds_busy_status_upon_creation()
    {
        $game = Api::bootGame();
        $this->assertEquals(Api::GAME_BUSY, $game->getStatus());
    }
}