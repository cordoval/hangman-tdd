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
}