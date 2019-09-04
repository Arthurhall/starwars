<?php

namespace App\Controller;

use App\Client\SwApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/{_locale}/films", name="film_index")
     */
    public function index(SwApiClient $client)
    {
        return $this->render('film/index.html.twig', [
            'films' => $client->getFilms(),
        ]);
    }
}
