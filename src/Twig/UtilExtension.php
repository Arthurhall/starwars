<?php

namespace App\Twig;

use ReflectionClass;
use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class UtilExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('short_class_name', [$this, 'getShortClassName']),
        ];
    }

    public function getShortClassName($object)
    {
        return (new ReflectionClass($object))->getShortName();
    }
}
