<?php

namespace Qandidate;

use \SplFileObject;

class WordList
{
    const DATA_PATH = __DIR__.'/../data/words.english';

    /** @var SplFileObject */
    protected $file;

    public static function boot($dataPath = self::DATA_PATH)
    {
        return new self($dataPath);
    }

    public function getWordAt($line)
    {
        $this->file->seek($line);

        return rtrim($this->file->current(), "\n");
    }

    private function __construct($dataPath)
    {
        $this->file = new SplFileObject($dataPath);
    }
}