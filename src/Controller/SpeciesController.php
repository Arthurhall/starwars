<?php

namespace App\Controller;

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
            'species_collection' => $swApiManager->species()->index($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/{_locale}/species/{id}", name="species_show")
     */
    public function show($id, SwApiManager $swApiManager)
    {
        return $this->render('species/show.html.twig', [
            'species' => $swApiManager->species()->get($id),
        ]);
    }
}
