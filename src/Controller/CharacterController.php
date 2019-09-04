<?php

namespace App\Controller;

use App\Client\SwApiClient;
use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CharacterController extends AbstractController
{
    /**
     * @Route("/{_locale}/characters", name="character_index")
     */
    public function index(SwApiManager $swApiManager, Request $request)
    {
        return $this->render('character/index.html.twig', [
            'characters' => $swApiManager->characters()->index($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/{_locale}/characters/{id}", name="character_show")
     */
    public function show($id, SwApiClient $client)
    {
        return $this->render('character/show.html.twig', [
            'character' => $client->getCharacter($id),
        ]);
    }
}
