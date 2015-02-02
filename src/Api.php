<?php

namespace Qandidate;

class Api
{
    const GAME_BUSY = 'busy';
    const GAME_FAIL = 'fail';
    const GAME_SUCCESS = 'success';

    protected $uuid;
    protected $mask;
    protected $word;
    protected $triesLeft;
    protected $status;

    public static function bootGame()
    {
        return new self();
    }

    public function __construct($seedWord = 'someword')
    {
        $this->uuid = uniqid();
        $this->word = str_split($seedWord);
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

        $this->updateState();
    }

    public function getStatus()
    {
        return $this->status;
    }

    private function updateState()
    {
        if ($this->triesLeft < 1) {
            $this->status = self::GAME_FAIL;

            return;
        }

        $isCompleted = true;
        if (in_array('.', $this->mask)) {
            $isCompleted = false;
        }

        if ($isCompleted) {
            $this->status = self::GAME_SUCCESS;
        }
    }
}