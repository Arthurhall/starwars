<?php

namespace App\Paginator;

class SwPaginator
{
    /**
     * @var UrlToPageConverter
     */
    private $urlToPageConverter;

    /**
     * @param UrlToPageConverter $urlToPageConverter
     */
    public function __construct(UrlToPageConverter $urlToPageConverter)
    {
        $this->urlToIdConverter = $urlToIdConverter;
        $this->urlToPageConverter = $urlToPageConverter;
        $this->client = $client;
    }

    public function paginate($param)
    {

    }
}
