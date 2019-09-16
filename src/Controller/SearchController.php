<?php

namespace App\Controller;

use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    /**
     * @Route("/{_locale}/search", name="search_autocomplete")
     */
    public function autocomplete(Request $request, SwApiManager $manager)
    {
        $characters = $manager->characters()->index(1, $request->query->get('search'));
        $films = $manager->films()->index(1, $request->query->get('search'));
        $planets = $manager->planets()->index(1, $request->query->get('search'));
        $species = $manager->species()->index(1, $request->query->get('search'));
        $starships = $manager->starships()->index(1, $request->query->get('search'));
        $vehicles = $manager->vehicles()->index(1, $request->query->get('search'));

        return $this->render('search/autocomplete.html.twig', [
            'characters' => $characters,
            'films' => $films,
            'planets' => $planets,
            'species' => $species,
            'starships' => $starships,
            'vehicles' => $vehicles,
        ]);
    }
}
