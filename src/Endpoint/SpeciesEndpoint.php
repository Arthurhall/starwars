<?php

namespace App\Endpoint;

use App\Model\Collection;
use App\Model\Species;

class SpeciesEndpoint extends AbstractEndpoint
{
    /**
     *
     * @param int $page
     * @param string $search
     *
     * @return Collection|Species[]
     */
    public function index($page = 1, string $search = null)
    {
        $response = $this->client->getSpecies($page, $search);

        return $this->hydrateMany($response, Species::class, $page);
    }

    /**
     * @param mixed $id
     *
     * @return Species
     */
    public function get($id)
    {
        $response = $this->client->getOneSpecies($this->parseId($id));

        return $this->hydrateOne($response, Species::class);
    }
}
