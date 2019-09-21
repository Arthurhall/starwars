<?php

namespace App\Endpoint;

use App\Model\Collection;
use App\Model\Starship;

class StarshipsEndpoint extends AbstractEndpoint
{
    /**
     * @param int $page
     * @param string $search
     * @return Collection|Starship[]
     */
    public function index($page = 1, string $search = null)
    {
        $response = $this->client->getStarships($page, $search);

        return $this->hydrateMany($response, Starship::class, $page);
    }

    /**
     * @param mixed $id
     * @return Starship
     */
    public function get($id)
    {
        $response = $this->client->getStarship($this->parseId($id));

        return $this->hydrateOne($response, Starship::class);
    }
}
