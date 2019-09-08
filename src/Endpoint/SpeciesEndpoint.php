<?php

namespace App\Endpoint;

use App\Model\Species;

class SpeciesEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
        $response = $this->client->getSpecies($page);

        return $this->hydrateMany($response, Species::class, $page);
    }

    public function get($id)
    {
        $response = $this->client->getOneSpecies($this->parseId($id));

        return $this->hydrateOne($response, Species::class);
    }
}
