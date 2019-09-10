<?php

namespace App\Endpoint;

use App\Model\Character;

class CharactersEndpoint extends AbstractEndpoint
{
    public function index($page = 1, string $search = null)
    {
        $response = $this->client->getCharacters($page, $search);

        return $this->hydrateMany($response, Character::class, $page);
    }

    public function get($id)
    {
        $response = $this->client->getCharacter($this->parseId($id));

        return $this->hydrateOne($response, Character::class);
    }
}
