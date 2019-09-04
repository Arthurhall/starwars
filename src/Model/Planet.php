<?php

namespace App\Model;

class Planet
{
    /** @var string */
    public $name;
    /** @var string */
    public $diameter;
    /** @var string */
    public $rotation_period;
    /** @var string */
    public $orbital_period;
    /** @var string */
    public $gravity;
    /** @var string */
    public $population;
    /** @var string */
    public $climate;
    /** @var string */
    public $terrain;
    /** @var string */
    public $surface_water;
    /** @var \App\Model\Character[] */
    public $residents;
    /** @var \App\Model\Film[] */
    public $films;
    /** @var \DateTime */
    public $created;
    /** @var \DateTime */
    public $edited;
    /** @var string */
    public $url;

    public function __construct($url = null)
    {
        $this->url = $url;
    }
}
