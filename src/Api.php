<?php

namespace Qandidate;

use Qandidate\Exception\GameHasAlreadyEnded;

class Api
{
    const GAME_BUSY = 'busy';
    const GAME_FAIL = 'fail';
    const GAME_SUCCESS = 'success';
    const MAXIMUM_NUMBER_OF_FAILED_ATTEMPTS = 11;
    const DEFAULT_SEED_WORD = 'someword';

    const UNKNOWN_CHARACTER = '.';
    const FROM_A_TO_Z = '/^[a-z]$/';

    private $uuid;
    private $triesLeft;
    private $status;

    private $mask;
    private $word;

    public static function bootGame($seedWord = self::DEFAULT_SEED_WORD)
    {
        return new self($seedWord);
    }

    public function guessCharacter($attemptedCharacter)
    {
        $this->guardGameIsNotOver();

        $this->validateInput($attemptedCharacter);

        if ($this->word->hasCharacter($attemptedCharacter)) {
            $this->mask = $this->mask->unveilCharacter($attemptedCharacter);
        } else {
            $this->triesLeft--;
        }

        $this->updateState();
    }

    public function __toString()
    {
        return $this->uuid;
    }

    public function getTriesLeft()
    {
        return $this->triesLeft;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getMask()
    {
        return (string) $this->mask;
    }

    public function getWord()
    {
        return (string) $this->word;
    }

    private function __construct($seedWord)
    {
        $this->uuid = uniqid();
        $this->triesLeft = self::MAXIMUM_NUMBER_OF_FAILED_ATTEMPTS;
        $this->status = self::GAME_BUSY;

        $this->word = new Word($seedWord);
        $this->mask = new Mask($this->word, null, self::UNKNOWN_CHARACTER);
    }

    private function updateState()
    {
        if ($this->triesLeft < 1) {
            $this->status = self::GAME_FAIL;

            return;
        }

        if (!$this->mask->hasUnknownCharacters()) {
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

    private function hasGameEnded()
    {
        return $this->status === self::GAME_SUCCESS || $this->status === self::GAME_FAIL;
    }
}