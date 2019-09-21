<?php

namespace App\Controller;

use App\Chart\CharacterData;
use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
            'characters' => $swApiManager->characters()->index(
                $request->query->getInt('page', 1),
                $request->query->get('search')
            ),
        ]);
    }

    /**
     * @Route("/{_locale}/characters/{id}", name="character_show")
     */
    public function show($id, SwApiManager $swApiManager)
    {
        return $this->render('character/show.html.twig', [
            'character' => $swApiManager->characters()->get($id),
        ]);
    }

    /**
     * @Route("/{_locale}/characters/chart/year-mass-height", name="character_chart_year_mass_height")
     */
    public function chartBearthYear(CharacterData $data)
    {
        return new JsonResponse($data->getDataBirthYear());
    }
}
