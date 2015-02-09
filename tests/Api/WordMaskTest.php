<?php

namespace Qandidate\Tests\Api;

use Qandidate\Mask;
use Qandidate\Word;

class WordMaskTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_represents_a_word()
    {
        $word = new Word('someword');
        $this->assertEquals('someword', (string) $word);
        $this->assertEquals(8, $word->getLength());
        $this->assertTrue($word->hasCharacter('e'));
        $this->assertFalse($word->hasCharacter('f'));
    }

    /** @test */
    public function it_can_tell_where_at_a_given_character_is()
    {
        $word = new Word('someword');

        $this->assertEquals([1, 5], $word->whereAtIs('o'));
    }

    /** @test */
    public function it_can_fetch_character_at_a_given_position()
    {
        $word = new Word('someword');

        $this->assertEquals('o', $word->getCharacterAt(5));
    }

    /** @test */
    public function it_represents_a_mask()
    {
        $word = new Word('someword');
        $mask = new Mask($word);
        $this->assertEquals('someword', (string) $mask->getWord());
        $this->assertEquals($word->getLength(), $mask->getLength());
        $this->assertEquals('........', (string) $mask);
        $this->assertTrue($mask->hasUnknownCharacters());

        $secondMask = $mask->unveilCharacter('o');
        $this->assertEquals('.o...o..', (string) $secondMask);
        $this->assertEquals($mask->getword(), $secondMask->getWord());
        $this->assertEquals($mask->getLength(), $secondMask->getLength());

        $thirdMask = $secondMask->unveilCharacter('o');
        $this->assertEquals('.o...o..', (string) $thirdMask);
        $this->assertEquals($thirdMask->getword(), $secondMask->getWord());
        $this->assertEquals($thirdMask->getLength(), $secondMask->getLength());

        $fourthMask = $thirdMask->unveilCharacter('s');
        $fifthMask = $fourthMask->unveilCharacter('m');
        $sixthMask = $fifthMask->unveilCharacter('e');
        $seventhMask = $sixthMask->unveilCharacter('w');
        $eightMask = $seventhMask->unveilCharacter('r');
        $nineMask = $eightMask->unveilCharacter('d');

        $this->assertFalse($nineMask->hasUnknownCharacters());
    }
}