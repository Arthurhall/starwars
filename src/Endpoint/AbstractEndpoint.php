<?php

namespace App\Endpoint;

use App\Client\SwApiClient;
use App\Converter\UrlToIdConverter;
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
     * @var UrlToIdConverter
     */
    protected $urlToIdConverter;

    /**
     * @var array
     */
    protected $serializerGroups;

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
     * @param array $groups
     */
    public function setSerializerGroups(array $groups = [])
    {
        $this->serializerGroups = $groups;

        return $this;
    }

    /**
     * @param UrlToIdConverter $urlToIdConverter
     */
    public function setUrlToIdConverter(UrlToIdConverter $urlToIdConverter)
    {
        $this->urlToIdConverter = $urlToIdConverter;
    }

    /**
     * @param ResponseInterface $response
     * @param string $class
     *
     * @return Character|Film|Planet|Species|Starship|Vehicle
     */
    protected function hydrateOne(ResponseInterface $response, string $class)
    {
        return $this->serializer->deserialize(
            $response->getBody()->getContents(),
            $class,
            'json',
            $this->getContext(),
        );
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
        $this->serializerGroups = ['property'];
        $results = $this->serializer->denormalize($data['results'], $class.'[]', 'json', $this->getContext());

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

    /**
     * @return array
     */
    private function getContext()
    {
        $context = [
            'enable_max_depth' => true,
        ];
        if ($this->serializerGroups) {
            $context['groups'] = $this->serializerGroups;
        }

        return $context;
    }
}
