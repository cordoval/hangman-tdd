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
    public function it_initialize_word_and_initial_guess_of_the_same_length()
    {
        $game = Api::bootGame();
        $this->assertEquals(strlen($game->getMask()), strlen($game->getWord()));
    }
}