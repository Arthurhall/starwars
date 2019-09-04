<?php

namespace App\Endpoint;

use App\Model\Film;
use App\Model\Collection;

class FilmsEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
//        usort($films, function($a, $b) {
//            return $a['episode_id'] - $b['episode_id'];
//        });
        $request = $this->http->createRequest("GET", sprintf("films/?page=%d", $page));
        $response = $this->http->send($request);

        $collection = new Collection;

        if ($response->getStatusCode() == 200) {
            return $this->hydrateMany($response->json(), 'App\Model\Film');
        }

        return $this->handleResponse($response, $request, $collection);
    }

    public function get($id)
    {
        $request = $this->http->createRequest("GET", sprintf("films/%d/", $id));
        $response = $this->http->send($request);

        if ($response->getStatusCode() == 200) {
            return $this->hydrateOne($response->json(), new Film);
        }

        return $this->handleResponse($response, $request);
    }
}
