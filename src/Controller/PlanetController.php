<?php

namespace App\Controller;

use App\Chart\PlanetData;
use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PlanetController extends AbstractController
{
    /**
     * @Route("/{_locale}/planets", name="planet_index")
     */
    public function index(SwApiManager $swApiManager, Request $request)
    {
        return $this->render('planet/index.html.twig', [
            'planets' => $swApiManager->planets()->index(
                $request->query->getInt('page', 1),
                $request->query->get('search')
            ),
        ]);
    }

    /**
     * @Route("/{_locale}/planets/{id}", name="planet_show")
     */
    public function show($id, SwApiManager $swApiManager)
    {
        return $this->render('planet/show.html.twig', [
            'planet' => $swApiManager->planets()->get($id),
        ]);
    }

    /**
     * @Route("/{_locale}/planets/chart/diameter-population", name="planet_chart_diameter_population")
     */
    public function chartDiameterPopulation(PlanetData $data)
    {
        return new JsonResponse($data->getDataDiameterPopulation());
    }

    /**
     * @Route("/{_locale}/planets/chart/population", name="planet_chart_population")
     */
    public function chartPopulation(PlanetData $data)
    {
        return new JsonResponse($data->getDataPopulation());
    }
}
