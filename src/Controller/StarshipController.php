<?php

namespace App\Controller;

use App\Client\SwApiClient;
use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
}
