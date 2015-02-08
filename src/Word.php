<?php

namespace Qandidate;

class Word
{
    private $value;

    public function __construct($nativeRepresentation)
    {
        $this->value = str_split($nativeRepresentation);
    }

    public function __toString()
    {
        return implode('', $this->value);
    }

    public function getLength()
    {
        return sizeof($this->value);
    }

    public function hasCharacter($character)
    {
        return in_array($character, $this->value);
    }
}