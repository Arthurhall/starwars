<?php

namespace App\Endpoint;

use App\Model\Character;
use App\Model\Collection;

class CharactersEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
        $request = $this->http->createRequest("GET", sprintf("people/?page=%d", $page));
        $response = $this->http->send($request);

        $collection = new Collection;

        if ($response->getStatusCode() == 200) {
            return $this->hydrateMany($response->json(), 'App\Model\Character');
        }

        return $this->handleResponse($response, $request, $collection);
    }

    public function get($id)
    {
        if (is_string($id)) {
            $response = $this->client->getCharacter($this->urlToIdConverter->convert($id));
        } else {
            $response = $this->client->getCharacter($id);
        }

        return $this->hydrateOne($response, Character::class);
    }
}
