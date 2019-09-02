<?php

namespace App\Controller;

use App\Client\SwClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/{_locale}", name="home_index")
     */
    public function index(SwClient $client)
    {
        return $this->redirectToRoute('film_index');
    }
}
