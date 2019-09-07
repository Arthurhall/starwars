<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Planet
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
     * @var \App\Model\Character[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $residents;
    /**
     * @var \App\Model\Film[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $films;
    /**
     * @var \DateTime
     * @Groups("property")
     */
    public $created;
    /**
     * @var \DateTime
     * @Groups("property")
     */
    public $edited;
    /**
     * @var string
     * @Groups("property")
     */
    public $url;

    public function __construct($url = null)
    {
        $this->url = $url;
    }
}
