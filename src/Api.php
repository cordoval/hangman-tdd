<?php

namespace Qandidate;

use Qandidate\Exception\GameHasAlreadyEnded;

class Api
{
    const GAME_BUSY = 'busy';
    const GAME_FAIL = 'fail';
    const GAME_SUCCESS = 'success';
    const MAXIMUM_NUMBER_OF_FAILED_ATTEMPTS = 11;
    const UNKNOWN_CHARACTER = '.';
    const FROM_A_TO_Z = '/^[a-z]$/';
    const DEFAULT_SEED_WORD = 'someword';

    private $uuid;
    private $mask;
    private $word;
    private $triesLeft;
    private $status;

    public static function bootGame($seedWord = self::DEFAULT_SEED_WORD)
    {
        return new self($seedWord);
    }

    public function guessCharacter($attemptedCharacter)
    {
        $this->guardGameIsNotOver();

        $this->validateInput($attemptedCharacter);

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

    public function hasGameEnded()
    {
        return $this->status === self::GAME_SUCCESS || $this->status === self::GAME_FAIL;
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

    public function getStatus()
    {
        return $this->status;
    }

    public function __toString()
    {
        return $this->uuid;
    }

    private function __construct($seedWord)
    {
        $this->uuid = uniqid();
        $this->word = str_split($seedWord);
        $this->mask = array_fill(0, sizeof($this->word), self::UNKNOWN_CHARACTER);
        $this->triesLeft = self::MAXIMUM_NUMBER_OF_FAILED_ATTEMPTS;
        $this->status = self::GAME_BUSY;
    }

    private function updateState()
    {
        if ($this->triesLeft < 1) {
            $this->status = self::GAME_FAIL;

            return;
        }

        if (!in_array(self::UNKNOWN_CHARACTER, $this->mask)) {
            $this->status = self::GAME_SUCCESS;
        }
    }

    private function validateInput($attemptedCharacter)
    {
        if (!preg_match(self::FROM_A_TO_Z, $attemptedCharacter)) {
            throw new \InvalidArgumentException('Please provide input with pattern a-z');
        }
    }

    private function guardGameIsNotOver()
    {
        if ($this->hasGameEnded()) {
            throw new GameHasAlreadyEnded();
        }
    }
}