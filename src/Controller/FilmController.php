<?php

namespace App\Controller;

use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/{_locale}/films", name="film_index")
     */
    public function index(SwApiManager $swApiManager, Request $request)
    {
        return $this->render('film/index.html.twig', [
            'films' => $swApiManager->films()->index($request->query->getInt('page', 1)),
        ]);
    }

    /**
     * @Route("/{_locale}/films/{id}", name="film_show")
     */
    public function show($id, SwApiManager $swApiManager)
    {
        dump($swApiManager->films()->get($id));
        return $this->render('film/show.html.twig', [
            'film' => $swApiManager->films()->get($id),
        ]);
    }
}
