<?php

namespace App\Twig;

use App\Client\SwClient;
use App\Converter\UrlToIdConverter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class SwClientExtension extends AbstractExtension
{
    /**
     * @var UrlToIdConverter
     */
    private $urlToIdConverter;

    /**
     * @var SwClient
     */
    private $client;

    /**
     * @param UrlToIdConverter $urlToIdConverter
     */
    public function __construct(UrlToIdConverter $urlToIdConverter, SwClient $client)
    {
        $this->urlToIdConverter = $urlToIdConverter;
        $this->client = $client;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('url_to_id', [$this, 'urlToId']),
            new TwigFilter('get_people', [$this, 'getPeople']),
            new TwigFilter('get_film', [$this, 'getFilm']),
        ];
    }

    public function urlToId($url)
    {
        return $this->urlToIdConverter->convert($url);
    }

    public function getPeople($id)
    {
        return $this->client->getPeople($id);
    }

    public function getFilm($id)
    {
        return $this->client->getFilm($id);
    }
}
