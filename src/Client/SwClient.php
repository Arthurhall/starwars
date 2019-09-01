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
     * @return array
     */
    public function getPlanets()
    {
        $contents = $this->get('planets');

        dump($contents);
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
