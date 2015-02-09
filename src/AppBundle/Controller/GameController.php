<?php

namespace Qandidate\AppBundle\Controller;

use Qandidate\Api;
use Qandidate\GameRepository;
use Qandidate\WordList;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GameController extends Controller
{
    const GOOD_GUESS = 1;
    const BAD_GUESS = 0;

    /**
     * @Route("/", name="start")
     * @Method("GET")
     */
    public function indexAction()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/games", name="new_game")
     * @Method("POST")
     */
    public function newGameAction(Request $request)
    {
        $wordList = WordList::boot($this->container->getParameter('kernel.root_dir').'/../data/words.english');
        $game = Api::bootGame($wordList->getWordAtRandom());

        $this->get('qandidate.repository.game')->save($game);

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
        $games = $this->get('qandidate.repository.game')->findAll();

        if ($request->isXmlHttpRequest()) {
            return JsonResponse::create(GameRepository::flatten($games));
        }

        return $this->render('default/all_games.html.twig', ['games' => $games]);
    }

    /**
     * @Route("/games/{id}", name="get_a_game")
     * @Method("GET")
     */
    public function getGameAction($id, Request $request)
    {
        $game = $this->get('qandidate.repository.game')->find($id);

        if ($request->isXmlHttpRequest()) {
            return JsonResponse::create(GameRepository::ajaxify($game));
        }

        return $this->render('default/game.html.twig', ['game' => $game]);
    }

    /**
     * @Route("/games/{id}", name="guess_character")
     * @Method("POST")
     */
    public function guessCharacterAction($id, Request $request)
    {
        $game = $this->get('qandidate.repository.game')->find($id);
        $char = '';

        if ($request->isXmlHttpRequest()) {
            if (!empty($request->getContent())) {
                $params = json_decode($request->getContent(), true);
                $char = $params['char'];
            }
        } else {
            $char = $request->request->get('char');
        }

        try {
            $isGoodGuess = $game->guessCharacter($char);
        } catch (\Exception $exception) {
            return JsonResponse::create(
                [
                    'status' => 'error',
                    'message' => $exception->getMessage(),
                ]
            );
        }

        $this->get('qandidate.repository.game')->save($game);

        if ($request->isXmlHttpRequest()) {
            return JsonResponse::create(
                [
                    'status' => 'success',
                    'message' => $isGoodGuess ? self::GOOD_GUESS : self::BAD_GUESS,
                    'game' => GameRepository::ajaxify($game),
                ]
            );
        }

        $this->addFlash('notice', $isGoodGuess ? 'Good guess!' : 'Bad guess :(');

        return $this->redirectToRoute('get_a_game', ['id' => (string) $game]);
    }
}
