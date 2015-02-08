<?php

namespace Qandidate\Tests\Api;

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
}