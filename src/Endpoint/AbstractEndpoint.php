<?php

namespace App\Endpoint;

use App\Client\SwApiClient;
use App\Model\Character;
use App\Model\Collection;
use App\Model\Film;
use App\Model\Planet;
use App\Model\Species;
use App\Model\Starship;
use App\Model\Vehicle;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractEndpoint
{
    const PER_PAGE = 10;

    /**
     * @var SwApiClient
     */
    protected $client;

    /**
     * @var Serializer
     */
    protected $serializer;

    /**
     * @param SwApiClient $client
     */
    public function setClient(SwApiClient $client)
    {
        $this->client = $client;
    }

    /**
     * @param Serializer $serializer
     */
    public function setSerializer(Serializer $serializer)
    {
        $this->serializer = $serializer;
    }

    /**
     * @param ResponseInterface $response
     * @param string $class
     *
     * @return Character|Film|Planet|Species|Starship|Vehicle
     */
    protected function hydrateOne(ResponseInterface $response, string $class)
    {
        return $this->serializer->deserialize($response->getBody()->getContents(), $class, 'json');
    }

    /**
     * @param ResponseInterface $response
     * @param string $class
     *
     * @return Collection
     */
    protected function hydrateMany(ResponseInterface $response, string $class, int $page)
    {
        $data = $this->serializer->decode($response->getBody()->getContents(), 'json');
        $results = $this->serializer->denormalize($data['results'], $class.'[]', 'json');

        $collection = new Collection($results);
        $collection->setEndpoint($this)
            ->setNext($data['next'])
            ->setPrevious($data['previous'])
            ->setTotalCount($data['count'])
            ->setCurrentPage($page);

        $collection->setTotalPage(
            ceil($collection->getTotalCount() / self::PER_PAGE)
        );

        return $collection;
    }
}
