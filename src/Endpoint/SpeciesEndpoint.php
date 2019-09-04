<?php

namespace App\Endpoint;

use App\Model\Species;
use App\Model\Collection;

class SpeciesEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
        $request = $this->http->createRequest("GET", sprintf("species/?page=%d", $page));
        $response = $this->http->send($request);

        $collection = new Collection;

        if ($response->getStatusCode() == 200) {
            return $this->hydrateMany($response->json(), 'App\Model\Species');
        }

        return $this->handleResponse($response, $request, $collection);
    }

    public function get($id)
    {
        $request = $this->http->createRequest("GET", sprintf("species/%d/", $id));
        $response = $this->http->send($request);

        if ($response->getStatusCode() == 200) {
            return $this->hydrateOne($response->json(), new Species);
        }

        return $this->handleResponse($response, $request);
    }
}
