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

    public static function ajaxify(Api $game)
    {
        return [
            'word' => (string) $game->getWord(),
            'tries_left' => $game->getTriesLeft(),
            'status' => $game->getStatus(),
            'mask' => (string) $game->getMask(),
        ];
    }

    public static function flatten(array $games)
    {
        return array_map(function ($game) { return self::ajaxify($game); }, $games);
    }
}