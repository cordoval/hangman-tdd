<?php

namespace Qandidate\Tests\Api;

use Qandidate\Api;
use Qandidate\Exception\GameHasReceivedInvalidInput;

class MoreSpecsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider getInvalidInput
     */
    public function it_throws_an_exception_when_passed_invalid_character_on_input($inputCharacter)
    {
        $this->setExpectedException(GameHasReceivedInvalidInput::class);
        $game = Api::bootGame();
        $game->guessCharacter($inputCharacter);
    }

    public function getInvalidInput()
    {
        return [
            ['1'],
            ['#'],
            ['32'],
            ['abcd'],
        ];
    }

    /** @test */
    public function it_does_and_does_not_decrement_dots_in_the_middle_of_a_game()
    {
        $game = Api::bootGame();
        $this->assertEquals(11, $game->getTriesLeft());
        $game->guessCharacter('p');
        $this->assertEquals(10, $game->getTriesLeft());
        $this->assertEquals('________', $game->getMask());
        $game->guessCharacter('s');
        $this->assertEquals(10, $game->getTriesLeft());
        $this->assertEquals('s_______', $game->getMask());
        $game->guessCharacter('o');
        $this->assertEquals(10, $game->getTriesLeft());
        $this->assertEquals('so___o__', $game->getMask());
    }

    /** @test */
    public function it_can_be_serialized_and_persisted_to_simple_key_value_data_store()
    {
        $game = Api::bootGame();
        $game->guessCharacter('s');
        $game->guessCharacter('o');
        $game->guessCharacter('m');
        $game->guessCharacter('e');
        $game->guessCharacter('z');
        $uuid = (string) $game;

        $serialized = serialize($game);
        $restoredObject = unserialize($serialized);

        $this->assertEquals('some_o__', $restoredObject->getMask());
        $this->assertEquals(10, $restoredObject->getTriesLeft());
        $this->assertEquals('someword', $restoredObject->getWord());
        $this->assertEquals(Api::GAME_BUSY, $restoredObject->getStatus());
        $this->assertEquals($uuid, (string) $restoredObject);
    }
}
