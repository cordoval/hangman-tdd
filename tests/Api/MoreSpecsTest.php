<?php

namespace Qandidate\Tests\Api;

use Qandidate\Api;

class MoreSpecs extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @dataProvider getInvalidInput
     */
    public function it_throws_an_exception_when_passed_invalid_character_on_input($inputCharacter)
    {
        $this->setExpectedException('InvalidArgumentException', 'Please provide input with pattern a-z');
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
    public function it_does_and_does_not_increment_dots_in_the_middle_of_a_game()
    {
        $game = Api::bootGame();
        $this->assertEquals(11, $game->getTriesLeft());
        $game->guessCharacter('p');
        $this->assertEquals(10, $game->getTriesLeft());
        $this->assertEquals('........', $game->getMask());
        $game->guessCharacter('s');
        $this->assertEquals(10, $game->getTriesLeft());
        $this->assertEquals('s.......', $game->getMask());
        $game->guessCharacter('o');
        $this->assertEquals(10, $game->getTriesLeft());
        $this->assertEquals('so...o..', $game->getMask());
    }
}