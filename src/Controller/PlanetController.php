<?php

namespace App\Controller;

use App\Client\SwClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PlanetController extends AbstractController
{
    /**
     * @Route("/planets", name="planet_index")
     */
    public function index(SwClient $client)
    {
        return $this->render('planet/index.html.twig', [
            'planets' => $client->getPlanets(),
        ]);
    }
}
