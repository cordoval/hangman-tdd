<?php

namespace Qandidate;

class Api
{
    protected $uuid;
    protected $word;

    public static function bootGame()
    {
        return new self();
    }

    public function __construct()
    {
        $this->uuid = uniqid();
        $this->word = '';
    }

    public function __toString()
    {
        return $this->uuid;
    }

    public function getWord()
    {
        return $this->word;
    }
}