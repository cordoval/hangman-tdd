<?php

namespace Qandidate;

class Api
{
    protected $uuid;
    protected $mask;
    protected $word;
    protected $triesLeft;

    public static function bootGame()
    {
        return new self();
    }

    public function __construct()
    {
        $this->uuid = uniqid();
        $this->word = str_split('someword');
        $this->mask = array_fill(0, sizeof($this->word), '.');
        $this->triesLeft = 11;
    }

    public function __toString()
    {
        return $this->uuid;
    }

    public function getMask()
    {
        return implode('', $this->mask);
    }

    public function getWord()
    {
        return implode('', $this->word);
    }

    public function getTriesLeft()
    {
        return $this->triesLeft;
    }

    public function guessCharacter($attemptedCharacter)
    {
        $isCorrect = false;
        foreach ($this->word as $key => $character) {
            if ($character === $attemptedCharacter) {
                $isCorrect = true;
                $this->mask[$key] = $this->word[$key];
            }
        }

        if (!$isCorrect) {
            $this->triesLeft--;
        }
    }
}