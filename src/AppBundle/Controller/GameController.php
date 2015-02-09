<?php

namespace Qandidate\AppBundle\Controller;

use Qandidate\Api;
use Qandidate\GameRepository;
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
    public function newGameAction(Request $request)
    {
        $game = Api::bootGame((WordList::boot())->getWordAtRandom());

        $this->get('repository.game')->save($game);

        if ($request->isXmlHttpRequest()) {
            return JsonResponse::create(GameRepository::ajaxify($game));
        }

        return $this->redirectToRoute('get_a_game', ['id' => (string) $game]);
    }

    /**
     * @Route("/games", name="all_games")
     * @Method("GET")
     */
    public function allGamesAction(Request $request)
    {
        $games = $this->get('repository.game')->findAll();

        if ($request->isXmlHttpRequest()) {
            return JsonResponse::create(GameRepository::flatten($games));
        }

        return $this->render('default/all_games.html.twig', ['games' => $games]);
    }

    /**
     * @Route("/games/{id}", name="get_a_game")
     * @Method("GET")
     * @ParameterConverter()
     */
    public function getGameAction(Api $game, Request $request)
    {
        if ($request->isXmlHttpRequest()) {
            return JsonResponse::create(GameRepository::ajaxify($game));
        }

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
            return JsonResponse::create(
                [
                    'status' => 'error',
                    'message' => 'Game has already ended'
                ]
            );
        }

        return $this->redirectToRoute('get_a_game', ['id' => (string) $game]);
    }
}
