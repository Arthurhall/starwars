<?php

namespace App\Converter;

class UrlToPageConverter
{
    public function convert($url)
    {
        $page = preg_replace('/(https:\/\/swapi\.co\/api\/)([a-z]+\/)(\?page=)(\d+)/', '${4}', $url);

        return (int) $page;
    }
}
