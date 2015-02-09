<?php

namespace Qandidate;

class SqlStorage implements GameStorage
{
    private $db;

    public function __construct()
    {
        $this->db = new \PDO();
    }

    public function save(Api $game)
    {
        $stmt = $this->db->prepare("INSERT INTO game (uuid, game) VALUES (:uuid, :game)");
        $stmt->bindValue(':uuid', (string) $game, SQLITE3_TEXT);
        $stmt->bindValue(':game', base64_encode(serialize($game)), SQLITE3_TEXT);
        $stmt->execute();
    }

    public function find($uuid)
    {
        $stmt = $this->db->prepare('SELECT * FROM game WHERE game.uuid = :uuid');
        $stmt->bindValue(':uuid', $uuid, SQLITE3_TEXT);
        $result = $stmt->execute();

        return unserialize(base64_decode($result->fetchArray(SQLITE3_ASSOC)['game']));
    }

    public static function wipeAndBoot()
    {
        touch(__DIR__.'/../data/games.db3');
        unlink(__DIR__.'/../data/games.db3');

        $db = new SQLite3(__DIR__.'/../data/games.db3');
        $db->exec('CREATE TABLE game (uuid STRING, game TEXT)');
        $db->close();
        chmod(__DIR__.'/../data/games.db3', 0777);
    }

    public function findAll()
    {
        $gameRows = $this->db->query('SELECT * FROM game WHERE 1 = 1')->fetchArray(SQLITE3_ASSOC);

        $callback = function ($item) {
            return unserialize(base64_decode($item));
        };

        return array_map($callback, $gameRows);
    }
}