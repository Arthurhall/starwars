<?php

namespace App\Endpoint;

use App\Model\Film;

class FilmsEndpoint extends AbstractEndpoint
{
    public function index($page = 1, string $search = null)
    {
        $response = $this->client->getFilms($page, $search);

        $collection = $this->hydrateMany($response, Film::class, $page);

        $collection->uasort(function (Film $a, Film $b) {
            return ((int) $a->episodeId < (int) $b->episodeId) ? -1 : 1;
        });

        return $collection;
    }

    public function get($id)
    {
        $response = $this->client->getFilm($this->parseId($id));

        return $this->hydrateOne($response, Film::class);
    }
}
