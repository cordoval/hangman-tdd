<?php

namespace Qandidate\Tests;

use Qandidate\Api;
use Qandidate\Memory;

class MemoryTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_stores_and_retrieves_with_key_value_store()
    {
        $game = Api::bootGame();
        $memory = new Memory();
        $memory->save($game);
        $recoveredObject = $memory->find((string) $game);
        $this->assertEquals($recoveredObject, $game);
    }
}