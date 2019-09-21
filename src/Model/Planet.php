<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Planet extends AbstractModel
{
    /**
     * @var string
     * @Groups("property")
     */
    public $name;
    /**
     * @var string
     * @Groups("property")
     */
    public $diameter;
    /**
     * @var string
     * @Groups("property")
     */
    public $rotationPeriod;
    /**
     * @var string
     * @Groups("property")
     */
    public $orbitalPeriod;
    /**
     * @var string
     * @Groups("property")
     */
    public $gravity;
    /**
     * @var string
     * @Groups("property")
     */
    public $population;
    /**
     * @var string
     * @Groups("property")
     */
    public $climate;
    /**
     * @var string
     * @Groups("property")
     */
    public $terrain;
    /**
     * @var string
     * @Groups("property")
     */
    public $surfaceWater;
    /**
     * @var Character[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $residents;
    /**
     * @var Film[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $films;

    public function getName()
    {
        return $this->name;
    }

    public function getSubName()
    {
        return $this->diameter;
    }

    public function getDiameterInt()
    {
        if ($this->diameter == 'unknown') {
            return false;
        }

        return (float) str_replace(',', '', $this->diameter);
    }

    public function getPopulationInt()
    {
        if ($this->population == 'unknown') {
            return false;
        }

        return (float) str_replace(',', '', $this->population);
    }
}
