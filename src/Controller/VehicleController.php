<?php

namespace App\Controller;

use App\Client\SwApiClient;
use App\Manager\SwApiManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VehicleController extends AbstractController
{
    /**
     * @Route("/{_locale}/vehicles", name="vehicle_index")
     */
    public function index(SwApiManager $swApiManager, Request $request)
    {
        return $this->render('vehicle/index.html.twig', [
            'vehicles' => $swApiManager->vehicles()->index(
                $request->query->getInt('page', 1),
                $request->query->get('search')
            ),
        ]);
    }

    /**
     * @Route("/{_locale}/vehicles/{id}", name="vehicle_show")
     */
    public function show($id, SwApiManager $swApiManager)
    {
        return $this->render('vehicle/show.html.twig', [
            'vehicle' => $swApiManager->vehicles()->get($id),
        ]);
    }
}
