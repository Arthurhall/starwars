<?php

namespace App\Controller;

use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
            'planets' => $swApiManager->planets()->index($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/{_locale}/planets/{id}", name="planet_show")
     */
    public function show($id, SwApiManager $swApiManager)
    {
        dump($swApiManager->planets()->get($id));
        return $this->render('planet/show.html.twig', [
            'planet' => $swApiManager->planets()->get($id),
        ]);
    }
}
