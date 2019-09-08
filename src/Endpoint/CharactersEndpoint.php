<?php

namespace App\Endpoint;

use App\Model\Character;

class CharactersEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
        $response = $this->client->getCharacters($page);

        return $this->hydrateMany($response, Character::class, $page);
    }

    public function get($id)
    {
        $response = $this->client->getCharacter($this->parseId($id));

        return $this->hydrateOne($response, Character::class);
    }
}
