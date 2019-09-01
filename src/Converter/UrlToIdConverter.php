<?php

namespace App\Converter;

class UrlToIdConverter
{
    public function convert($url)
    {
        $id = preg_replace('/(https:\/\/swapi\.co\/api\/)([a-z]+\/)(\d+)(\/)/', '${3}', $url);

        return (int) $id;
    }
}
