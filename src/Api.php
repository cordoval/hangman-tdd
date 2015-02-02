<?php

namespace Qandidate;

class Api
{
    protected $uuid;
    protected $mask;
    protected $word;

    public static function bootGame()
    {
        return new self();
    }

    public function __construct()
    {
        $this->uuid = uniqid();
        $this->word = 'someword';
        $this->mask = implode('', array_fill(0, strlen($this->word), '.'));
    }

    public function __toString()
    {
        return $this->uuid;
    }

    public function getMask()
    {
        return $this->mask;
    }

    public function getWord()
    {
        return $this->word;
    }
}