<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Character
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
    public $birthYear;
    /**
     * @var string
     * @Groups("property")
     */
    public $eyeColor;
    /**
     * @var string
     * @Groups("property")
     */
    public $gender;
    /**
     * @var string
     * @Groups("property")
     */
    public $hairColor;
    /**
     * @var string cm
     * @Groups("property")
     */
    public $height;
    /**
     * @var string kg
     * @Groups("property")
     */
    public $mass;
    /**
     * @var string
     * @Groups("property")
     */
    public $skinColor;
    /**
     * @var \App\Model\Planet
     * @Groups("property")
     */
    public $homeworld;
    /**
     * @var \App\Model\Film[]
     * @MaxDepth(1)
     */
    public $films = [];
    /**
     * @var \App\Model\Species[]
     * @MaxDepth(1)
     */
    public $species = [];
    /**
     * @var \App\Model\Starship[]
     * @MaxDepth(1)
     */
    public $starships = [];
    /**
     * @var \App\Model\Vehicle[]
     * @MaxDepth(1)
     */
    public $vehicles = [];
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
