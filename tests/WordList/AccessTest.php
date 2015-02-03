<?php

namespace Qandidate;

class AccessTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_fetches_first_word_from_large_file()
    {
        $wordList = WordList::boot();
        $this->assertEquals('aa', $wordList->getWordAt(0));
    }
}