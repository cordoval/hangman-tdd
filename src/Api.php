<?php

namespace Qandidate;

class Api
{
    const GAME_BUSY = 0;
    const GAME_FAIL = 1;
    const GAME_SUCCESS = 2;

    protected $uuid;
    protected $mask;
    protected $word;
    protected $triesLeft;
    protected $status;

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
        $this->status = self::GAME_BUSY;
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

    public function getStatus()
    {
        return $this->status;
    }
}