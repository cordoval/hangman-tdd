<?php

namespace Qandidate;

class InMemoryStorage implements \ArrayAccess, GameStorage
{
    private $bank;

    public function __construct()
    {
        $this->bank = [];
    }

    public function offsetExists($offset)
    {
        return isset($this->bank[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->bank[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->bank[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->bank[$offset]);
    }

    public function save(Api $game)
    {
        $this->bank[(string) $game] = serialize($game);
    }

    public function find($uuid)
    {
        return unserialize($this->bank[$uuid]);
    }

    public function findAll()
    {
        return array_map(function ($item) { return unserialize($item); }, $this->bank);
    }
}