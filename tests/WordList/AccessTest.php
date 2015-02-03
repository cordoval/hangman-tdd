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

    /** @test */
    public function it_fetches_third_word_from_large_file()
    {
        $wordList = WordList::boot();
        $this->assertEquals('aahed', $wordList->getWordAt(2));
    }

    /** @test */
    public function it_fetches_last_word_from_large_file()
    {
        $wordList = WordList::boot();
        $this->assertEquals('zzzs', $wordList->getWordAt(WordList::END_LINE_NUMBER_OF_FILE));
    }
}