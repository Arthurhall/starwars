<?php

namespace App\Endpoint;

use App\Model\Planet;

class PlanetsEndpoint extends AbstractEndpoint
{
    public function index(int $page = 1)
    {
        $response = $this->client->getPlanets($page);

        return $this->hydrateMany($response, Planet::class, $page);
    }

    public function get($id)
    {
        if (is_string($id)) {
            $response = $this->client->getPlanet($this->urlToIdConverter->convert($id));
        } else {
            $response = $this->client->getPlanet($id);
        }

        return $this->hydrateOne($response, Planet::class);
    }
}
