<?php

namespace Qandidate;

use PDO;

class SqlStorage implements GameStorage
{
    private $db;

    public function __construct($database_name, $database_username, $database_password)
    {
        $this->db = new PDO('mysql:host=localhost;dbname='.$database_name, $database_username, $database_password);
    }

    public function save(Api $game)
    {
        $stmt = $this->db->prepare("INSERT INTO game (uuid, game) VALUES (:uuid, :game)");
        $uuid = (string) $game;
        $serialized = serialize($game);
        $stmt->bindParam(':uuid', $uuid);
        $stmt->bindParam(':game', $serialized);
        $stmt->execute();
    }

    public function find($uuid)
    {
        $stmt = $this->db->prepare('SELECT * FROM game WHERE game.uuid = :uuid');
        $stmt->bindParam(':uuid', $uuid);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return unserialize($result['game']);
    }

    public static function wipeAndBoot($database_name, $database_user, $database_password)
    {
        $db = new PDO('mysql:host=localhost;dbname='.$database_name, $database_user, $database_password);
        $db->exec('DROP TABLE IF EXISTS game');
        $db->exec('CREATE TABLE game (uuid VARCHAR(255), game TEXT)');
    }

    public function findAll()
    {
        $stmt = $this->db->prepare('SELECT * FROM game');
        $stmt->execute();
        $gameRows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $callback = function ($item) {
            return unserialize($item['game']);
        };

        return array_map($callback, $gameRows);
    }
}
