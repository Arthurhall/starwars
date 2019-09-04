<?php

namespace App\Twig;

use App\Client\SwApiClient;
use App\Converter\UrlToIdConverter;
use App\Converter\UrlToPageConverter;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class SwApiExtension extends AbstractExtension
{
    /**
     * @var UrlToIdConverter
     */
    private $urlToIdConverter;

    /**
     * @var UrlToPageConverter
     */
    private $urlToPageConverter;

    /**
     * @var SwApiClient
     */
    private $client;

    /**
     * @param UrlToIdConverter $urlToIdConverter
     * @param UrlToPageConverter $urlToPageConverter
     * @param SwApiClient $client
     */
    public function __construct(UrlToIdConverter $urlToIdConverter, UrlToPageConverter $urlToPageConverter, SwApiClient $client)
    {
        $this->urlToIdConverter = $urlToIdConverter;
        $this->urlToPageConverter = $urlToPageConverter;
        $this->client = $client;
    }

    public function getFilters()
    {
        return [
            new TwigFilter('url_to_id', [$this, 'urlToId']),
            new TwigFilter('url_to_page', [$this, 'urlToPage']),
            new TwigFilter('get_people', [$this, 'getPeople']),
            new TwigFilter('get_film', [$this, 'getFilm']),
        ];
    }

    public function urlToId($url)
    {
        return $this->urlToIdConverter->convert($url);
    }

    public function urlToPage($url)
    {
        return $this->urlToPageConverter->convert($url);
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