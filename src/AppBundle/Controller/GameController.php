<?php

namespace Qandidate\AppBundle\Controller;

use Qandidate\Api;
use Qandidate\WordList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    /**
     * @Route("/games", name="new_game")
     * @Method("POST")
     */
    public function newGameAction()
    {
        $wordList = WordList::boot();
        $game = Api::bootGame($wordList->getWordAtRandom());
        // @todo do tdd to repository service
        $this->get('repository.game')->save($game);

        $this->redirectToRoute('get_a_game', ['id' => (string) $game]);
    }

    /**
     * @Route("/games", name="all_games")
     * @Method("GET")
     */
    public function allGamesAction()
    {
        $games = $this->get('repository.game')->findAll();

        return $this->render('default/all_games.html.twig', ['games' => $games]);
    }

    /**
     * @Route("/games/{id}", name="get_a_game")
     * @Method("GET")
     * @ParameterConverter()
     */
    public function getGameAction(Api $game)
    {
        return $this->render('default/game.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/games/{id}", name="guess_character")
     * @Method("POST")
     * @ParameterConverter()
     */
    public function guessCharacterAction(Api $game, Request $request)
    {
        try {
            $game->guessCharacter($request->request->get('char'));
        } catch (\Exception $exception) {
            return JsonResponse::create(['status' => 'error', 'message' => 'Game has already ended']);
        }

        return $this->redirectToRoute('get_a_game', ['id' => (string) $game]);
    }
}
