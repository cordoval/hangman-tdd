<?php

namespace Qandidate\Tests\Web;

class Memory implements \ArrayAccess
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
}