<?php

namespace Qandidate;

use SQLite3;
use Symfony\Component\VarDumper\VarDumper;

class SqliteStorage implements GameStorage
{
    const DB_FILE_LOCATION = __DIR__.'/../data/games.db3';

    private $db;

    public function __construct()
    {
        $this->db = new SQLite3(self::DB_FILE_LOCATION);
    }

    public function save(Api $game)
    {
        $stmt = $this->db->prepare("INSERT INTO game (uuid, game) VALUES (:uuid, :game)");
        $stmt->bindValue(':uuid', (string) $game, SQLITE3_TEXT);
        $stmt->bindValue(':game', serialize($game), SQLITE3_TEXT);
        $stmt->execute();
    }

    public function find($uuid)
    {
        $stmt = $this->db->prepare('SELECT * FROM game WHERE game.uuid = :uuid');
        $stmt->bindValue(':uuid', $uuid, SQLITE3_TEXT);
        $result = $stmt->execute();
        VarDumper::dump($result->fetchArray(SQLITE3_ASSOC)['game']);
        return unserialize(1);
    }

    public static function wipeAndBoot()
    {
        touch(self::DB_FILE_LOCATION);
        unlink(self::DB_FILE_LOCATION);

        $db = new SQLite3(self::DB_FILE_LOCATION);
        $db->exec('CREATE TABLE game (uuid STRING, game TEXT)');
    }
}