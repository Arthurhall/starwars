<?php

namespace App\Model;

use DateTime;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Species extends AbstractModel
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
    public $classification;
    /**
     * @var string
     * @Groups("property")
     */
    public $designation;
    /**
     * @var string
     * @Groups("property")
     */
    public $averageHeight;
    /**
     * @var string
     * @Groups("property")
     */
    public $averageLifespan;
    /**
     * @var string
     * @Groups("property")
     */
    public $eyeColors;
    /**
     * @var string
     * @Groups("property")
     */
    public $hairColors;
    /**
     * @var string
     * @Groups("property")
     */
    public $skinColors;
    /**
     * @var string
     * @Groups("property")
     */
    public $language;
    /**
     * @var Planet
     * @Groups("relation")
     */
    public $homeworld;
    /**
     * @var Character[]
     * @Groups("relation")
     */
    public $people;
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
        return $this->classification;
    }
}
