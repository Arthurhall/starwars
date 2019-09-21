<?php

namespace App\Controller;

use App\Chart\StarshipData;
use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StarshipController extends AbstractController
{
    /**
     * @Route("/{_locale}/starships", name="starship_index")
     */
    public function index(SwApiManager $swApiManager, Request $request)
    {
        return $this->render('starship/index.html.twig', [
            'starships' => $swApiManager->starships()->index(
                $request->query->getInt('page', 1),
                $request->query->get('search')
            ),
        ]);
    }

    /**
     * @Route("/{_locale}/starships/{id}", name="starship_show")
     */
    public function show($id, SwApiManager $swApiManager)
    {
        return $this->render('starship/show.html.twig', [
            'starship' => $swApiManager->starships()->get($id),
        ]);
    }

    /**
     * @Route("/{_locale}/starships/chart/price", name="starship_chart_price")
     */
    public function chartPrice(StarshipData $data)
    {
        return new JsonResponse($data->getDataPrice());
    }
}
