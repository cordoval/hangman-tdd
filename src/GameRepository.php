<?php

namespace Qandidate;

class GameRepository
{
    /** @var GameStorage */
    private $storage;

    public function __construct(GameStorage $storage)
    {
        $this->storage = $storage;
    }

    public function save(Api $game)
    {
        $this->storage->save($game);
    }

    public function find($uuid)
    {
        return $this->storage->find($uuid);
    }
}