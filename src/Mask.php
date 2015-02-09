<?php

namespace Qandidate;

class Mask
{
    const SHOW = 1;
    const HIDE = 0;
    const DEFAULT_MASK_CHARACTER = '.';

    private $word;
    private $value;
    private $maskCharacter;

    public function __construct(Word $word, $seedValue = null, $maskCharacter = self::DEFAULT_MASK_CHARACTER)
    {
        $this->word = $word;
        $this->value = null === $seedValue ? array_fill(0, $word->getLength(), self::HIDE) : $seedValue;
        $this->maskCharacter = $maskCharacter;
    }

    public function __toString()
    {
        $maskedWord = [];
        foreach ($this->value as $key => $showOrHide) {
            $maskedWord[$key] = $showOrHide ? $this->word->getCharacterAt($key) : $this->maskCharacter;
        }

        return implode('', $maskedWord);
    }

    public function getWord()
    {
        return $this->word;
    }

    public function getLength()
    {
        return $this->word->getLength();
    }

    public function hasUnknownCharacters()
    {
        return in_array(self::HIDE, $this->value);
    }

    public function unveilCharacter($character)
    {
        $newValue = $this->value;
        if ($this->word->hasCharacter($character)) {
            foreach ($this->word->whereAtIs($character) as $index) {
                $newValue[$index] = self::SHOW;
            }
        }

        return new self($this->getWord(), $newValue, $this->maskCharacter);
    }
}
