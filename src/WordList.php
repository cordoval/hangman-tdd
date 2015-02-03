<?php

namespace Qandidate;

class WordList
{
    const DATA_PATH = __DIR__.'/../data/words.english';

    public static function boot($dataPath = self::DATA_PATH)
    {
        return new self($dataPath);
    }

    public function getWordAt()
    {

    }

    private function __construct($dataPath)
    {

    }
}