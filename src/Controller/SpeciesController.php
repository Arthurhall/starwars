<?php

namespace App\Controller;

use App\Client\SwApiClient;
use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SpeciesController extends AbstractController
{
    /**
     * @Route("/{_locale}/species", name="species_index")
     */
    public function index(SwApiManager $swApiManager, Request $request)
    {
        return $this->render('species/index.html.twig', [
            'species' => $swApiManager->species()->index($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/{_locale}/species/{id}", name="species_show")
     */
    public function show($id, SwApiClient $client)
    {
        return $this->render('species/show.html.twig', [
            'species' => $client->getOneSpecies($id),
        ]);
    }
}
