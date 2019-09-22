<?php

namespace App\Converter;

class StrToNumConverter
{
    public function convert($str)
    {
        if ($str == 'unknown') {
            return false;
        }

        return (float) str_replace(',', '', $str);
    }
}
