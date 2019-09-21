<?php

namespace App\Endpoint;

use App\Model\Character;
use App\Model\Collection;

class CharactersEndpoint extends AbstractEndpoint
{
    /**
     * @param int $page
     * @param string $search
     * @return Collection|Character[]
     */
    public function index($page = 1, string $search = null)
    {
        $response = $this->client->getCharacters($page, $search);

        return $this->hydrateMany($response, Character::class, $page);
    }

    /**
     * @param mixed $id
     * @return Character
     */
    public function get($id)
    {
        $response = $this->client->getCharacter($this->parseId($id));

        return $this->hydrateOne($response, Character::class);
    }
}
