<?php

namespace App\Endpoint;

use App\Model\Film;

class FilmsEndpoint extends AbstractEndpoint
{
    public function index($page = 1)
    {
        $response = $this->client->getFilms($page);

        return $this->hydrateMany($response, Film::class, $page);
    }

    public function get($id)
    {
        if (is_string($id)) {
            $response = $this->client->getFilm($this->urlToIdConverter->convert($id));
        } else {
            $response = $this->client->getFilm($id);
        }

        return $this->hydrateOne($response, Film::class);
    }
}
