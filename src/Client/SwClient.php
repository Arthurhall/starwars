<?php

namespace App\Client;

use GuzzleHttp\Client;

class SwClient extends Client
{
    /**
     * @return array
     */
    public function getFilms()
    {
        $contents = $this->get('films');

        if (isset($contents['results'])) {
            $films = $contents['results'];
            usort($films, function($a, $b) {
                return $a['episode_id'] - $b['episode_id'];
            });

            return $films;
        } else {
            return [];
        }
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getFilm($id)
    {
        return $this->get(sprintf('films/%d', (int) $id));
    }

    /**
     * @return array
     */
    public function getPlanets()
    {
        return $this->get('planets');
    }

    /**
     * @param int $id
     *
     * @return array
     */
    public function getPlanet($id)
    {
        return $this->get(sprintf('planets/%d', (int) $id));
    }

    /**
     * @param int|null $id
     *
     * @return array
     */
    public function getPeople($id)
    {
        if (!$id) {
            return $this->get('people');
        } else {
            return $this->get(sprintf('people/%d', (int) $id));
        }
    }

    /**
     * @param string $uri
     * @param array $options
     *
     * @return array
     */
    public function get($uri, array $options = [])
    {
        $response = parent::get($uri, $options);

        return json_decode($response->getBody()->getContents(), true);
    }
}
