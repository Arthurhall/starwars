<?php

namespace App\Converter;

class YearToIntConverter
{
    public function convert($year)
    {
        if ($year == 'unknown') {
            return false;
        }

        preg_match('/^(\d+\.?\d*)(BBY|ABY)$/', $year, $matches);
        if (isset($matches[1])) {
            $year = (float) $matches[1];
            if (isset($matches[2]) && $matches[2] == 'BBY') {
                $year *= -1;
            }

            return $year;
        }
    }
}
