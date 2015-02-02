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
    public function a_new_game_has_not_been_guessed_a_word()
    {
        $game = Api::bootGame();
        $word = $game->getWord();
        $firstWord = strlen($word);
        $this->assertTrue($firstWord > 0 && 1 === preg_match('/^\.*$/', $word));


        $game = Api::bootGame();
        $word = $game->getWord();
        $secondWord = strlen($word);
        $this->assertNotEquals($firstWord, $secondWord);
        $this->assertTrue($secondWord > 0 && 1 === preg_match('/^\.*$/', $word));
    }
}