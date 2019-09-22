<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Vehicle extends AbstractModel
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
    public $model;
    /**
     * @var string
     * @Groups("property")
     */
    public $manufacturer;
    /**
     * @var string
     * @Groups("property")
     */
    public $costInCredits;
    /**
     * @var string
     * @Groups("property")
     */
    public $length;
    /**
     * @var string
     * @Groups("property")
     */
    public $maxAtmospheringSpeed;
    /**
     * @var string
     * @Groups("property") */
    public $crew;
    /**
     * @var string
     * @Groups("property") */
    public $passengers;
    /**
     * @var string
     * @Groups("property") */
    public $cargoCapacity;
    /**
     * @var string
     * @Groups("property") */
    public $consumables;
    /**
     * @var string
     * @Groups("property") */
    public $vehicleClass;
    /**
     * @var Character[]
     * @Groups("relation")
     */
    public $pilots;
    /**
     * @var Film[]
     * @Groups("relation")
     */
    public $films;

    public function getName()
    {
        return $this->name;
    }

    public function getSubName()
    {
        return $this->model;
    }
}
