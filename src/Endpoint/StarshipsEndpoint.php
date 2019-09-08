<?php

namespace App\Endpoint;

use App\Model\Starship;

class StarshipsEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
        $response = $this->client->getStarships($page);

        return $this->hydrateMany($response, Starship::class, $page);
    }

    public function get($id)
    {
        $response = $this->client->getStarship($this->parseId($id));

        return $this->hydrateOne($response, Starship::class);
    }
}
