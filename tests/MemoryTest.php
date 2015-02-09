<?php

namespace Qandidate\Tests;

use Qandidate\Api;
use Qandidate\GameRepository;
use Qandidate\InMemoryStorage;
use Qandidate\SqlStorage;

class MemoryTest extends \PHPUnit_Framework_TestCase
{
    /** @test */
    public function it_in_memory_stores_and_retrieves_with_key_value_store()
    {
        $game = Api::bootGame();
        $memory = new InMemoryStorage();
        $memory->save($game);
        $recoveredObject = $memory->find((string) $game);
        $this->assertEquals($recoveredObject, $game);
    }

    /** @test */
    public function it_allows_for_more_than_one_implementation()
    {
        $game = Api::bootGame();
        $memory = new GameRepository(new InMemoryStorage());
        $memory->save($game);
        $recoveredObject = $memory->find((string) $game);
        $this->assertEquals($recoveredObject, $game);
    }

    /** @test */
    public function it_bears_an_sqlite_implementation()
    {
        $game = Api::bootGame();
        $memory = new GameRepository(new SqlStorage());
        $memory->save($game);
        $recoveredObject = $memory->find((string) $game);
        $this->assertEquals($recoveredObject, $game);
    }

    /** @test */
    public function it_fetches_all_games_for_in_memory()
    {
        $memory = new GameRepository(new InMemoryStorage());

        $firstGame = Api::bootGame();
        $memory->save($firstGame);

        $games = $memory->findAll();
        $this->assertCount(1, $games);

        $secondGame = Api::bootGame();
        $memory->save($secondGame);

        $games = $memory->findAll();
        $this->assertCount(2, $games);
    }

    /** @test */
    public function it_fetches_all_games_for_sqlite_driver()
    {
        $memory = new GameRepository(new SqlStorage());

        $firstGame = Api::bootGame();
        $memory->save($firstGame);

        $games = $memory->findAll();
        $this->assertCount(1, $games);

        $secondGame = Api::bootGame();
        $memory->save($secondGame);

        $games = $memory->findAll();
        $this->assertCount(2, $games);
    }
}