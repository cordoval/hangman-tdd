<?php

namespace Qandidate;

use SplFileObject;

class WordList
{
    const START_LINE_NUMBER_OF_FILE = 0;
    const END_LINE_NUMBER_OF_FILE = 274906;

    protected $file;

    public static function boot($dataPath)
    {
        return new self($dataPath);
    }

    public function getWordAt($line)
    {
        $this->file->seek($line);

        return rtrim($this->file->current(), "\n");
    }

    public function getWordAtRandom()
    {
        $randomLine = rand(self::START_LINE_NUMBER_OF_FILE, self::END_LINE_NUMBER_OF_FILE);

        return $this->getWordAt($randomLine);
    }

    private function __construct($dataPath)
    {
        $this->file = new SplFileObject($dataPath);
    }
}
