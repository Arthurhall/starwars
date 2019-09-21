<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Starship extends Vehicle
{
    /**
     * @var string
     * @Groups("property")
     */
    public $starshipClass;
    /**
     * @var string
     * @Groups("property")
     */
    public $hyperdriveRating;
    /**
     * @var string Vitesse "megalights per hour"
     * @Groups("property")
     */
    public $mglt;

    public function getName()
    {
        return $this->name;
    }

    public function getSubName()
    {
        return $this->model;
    }

    public function getPriceInt()
    {
        if ($this->costInCredits == 'unknown') {
            return false;
        }

        return (float) str_replace(',', '', $this->costInCredits);
    }
}
