<?php

namespace App\Endpoint;

use App\Model\Collection;
use App\Model\Planet;

class PlanetsEndpoint extends AbstractEndpoint
{
    /**
     * @param int $page
     * @param string $search
     * @return Collection|Planet[]
     */
    public function index(int $page = 1, string $search = null)
    {
        $response = $this->client->getPlanets($page, $search);

        return $this->hydrateMany($response, Planet::class, $page);
    }

    public function get($id)
    {
        $response = $this->client->getPlanet($this->parseId($id));

        return $this->hydrateOne($response, Planet::class);
    }
}
