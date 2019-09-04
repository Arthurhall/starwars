<?php

namespace App\Endpoint;

use App\Model\Starship;
use App\Model\Collection;

class StarshipsEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
        $request = $this->http->createRequest("GET", sprintf("starships/?page=%d", $page));
        $response = $this->http->send($request);

        $collection = new Collection;

        if ($response->getStatusCode() == 200) {
            return $this->hydrateMany($response->json(), 'App\Model\Starship');
        }

        return $this->handleResponse($response, $request, $collection);
    }

    public function get($id)
    {
        $request = $this->http->createRequest("GET", sprintf("starships/%d/", $id));
        $response = $this->http->send($request);

        if ($response->getStatusCode() == 200) {
            return $this->hydrateOne($response->json(), new Starship);
        }

        return $this->handleResponse($response, $request);
    }
}