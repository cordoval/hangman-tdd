<?php

namespace Qandidate;

interface GameStorage
{
    public function save(Api $game);
    public function find($uuid);
    public function findAll();
}