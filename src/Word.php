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

    public function getCharacterAt($position)
    {
        return $this->value[$position];
    }

    public function whereAtIs($character)
    {
        $indexes = [];
        foreach ($this->value as $key => $item) {
            if ($character === $item) {
                $indexes[] = $key;
            }
        }

        return $indexes;
    }
}