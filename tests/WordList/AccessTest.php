<?php

namespace Qandidate\tests\WordList;

use Qandidate\WordList;

class AccessTest extends \PHPUnit_Framework_TestCase
{
    protected $path;

    public function setUp()
    {
        $this->path = __DIR__.'/../../data/words.english';
    }

    /** @test */
    public function it_fetches_first_word_from_large_file()
    {
        $wordList = WordList::boot($this->path);
        $this->assertEquals('aa', $wordList->getWordAt(0));
    }

    /** @test */
    public function it_fetches_third_word_from_large_file()
    {
        $wordList = WordList::boot($this->path);
        $this->assertEquals('aahed', $wordList->getWordAt(2));
    }

    /** @test */
    public function it_fetches_last_word_from_large_file()
    {
        $wordList = WordList::boot($this->path);
        $this->assertEquals('zzzs', $wordList->getWordAt(WordList::END_LINE_NUMBER_OF_FILE));
    }

    /** @test */
    public function it_fetches_random_line()
    {
        $wordList = WordList::boot($this->path);
        foreach (range(1, 10) as $i) {
            $this->assertRegExp('/[a-z]([a-z])*/', $wordList->getWordAtRandom());
        }
    }
}
