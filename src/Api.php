<?php

namespace Qandidate;

class Api
{
    protected $uuid;

    public static function bootGame()
    {
        return new self();
    }

    public function __construct()
    {
        $this->uuid = uniqid();
    }

    public function __toString()
    {
        return $this->uuid;
    }
}