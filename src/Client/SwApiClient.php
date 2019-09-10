<?php

namespace App\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Psr\Http\Message\ResponseInterface;

class SwApiClient extends Client
{
    /**
     * @return ResponseInterface
     */
    public function getFilms(int $page = 1, string $search = null)
    {
        return $this->get(sprintf('films/?page=%d&search=%s', $page, $search));
    }

    /**
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function getFilm(int $id)
    {
        return $this->get(sprintf('films/%d/', $id));
    }

    /**
     * @return ResponseInterface
     */
    public function getPlanets(int $page = 1, string $search = null)
    {
        return $this->get(sprintf('planets/?page=%d&search=%s', $page, $search));
    }

    /**
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function getPlanet(int $id)
    {
        return $this->get(sprintf('planets/%d/', $id));
    }

    /**
     * @param int $page
     *
     * @return ResponseInterface
     */
    public function getCharacters(int $page = 1, string $search = null)
    {
        return $this->get(sprintf('people/?page=%d&search=%s', $page, $search));
    }

    /**
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function getCharacter(int $id)
    {
        return $this->get(sprintf('people/%d/', $id));
    }

    /**
     * @return ResponseInterface
     */
    public function getStarships(int $page = 1, string $search = null)
    {
        return $this->get(sprintf('starships/?page=%d&search=%s', $page, $search));
    }

    /**
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function getStarship(int $id)
    {
        return $this->get(sprintf('starships/%d/', $id));
    }

    /**
     * @return ResponseInterface
     */
    public function getVehicles(int $page = 1, string $search = null)
    {
        return $this->get(sprintf('vehicles/?page=%d&search=%s', $page, $search));
    }

    /**
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function getVehicle(int $id)
    {
        return $this->get(sprintf('vehicles/%d/', $id));
    }

    /**
     * @return ResponseInterface
     */
    public function getSpecies(int $page = 1, string $search = null)
    {
        return $this->get(sprintf('species/?page=%d&search=%s', $page, $search));
    }

    /**
     * @param int $id
     *
     * @return ResponseInterface
     */
    public function getOneSpecies(int $id)
    {
        return $this->get(sprintf('species/%d/', $id));
    }

    /**
     * @param string $uri
     * @param array $options
     *
     * @return type
     */
    public function get($uri, array $options = [])
    {
        try {
            return parent::get($uri, $options);
        } catch (ClientException $ex) {
            return $ex->getResponse();
        }
    }
}
