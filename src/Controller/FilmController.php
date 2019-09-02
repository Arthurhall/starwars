<?php

namespace App\Controller;

use App\Client\SwClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class FilmController extends AbstractController
{
    /**
     * @Route("/{_locale}/films", name="film_index")
     */
    public function index(SwClient $client)
    {
        return $this->render('film/index.html.twig', [
            'films' => $client->getFilms(),
        ]);
    }
}
