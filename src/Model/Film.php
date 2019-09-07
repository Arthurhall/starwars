<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Film
{
    /**
     * @var string
     * @Groups("property")
     */
    public $title;
    /**
     * @var int
     * @Groups("property")
     */
    public $episodeId;
    /**
     * @var string
     * @Groups("property")
     */
    public $openingCrawl;
    /**
     * @var string
     * @Groups("property")
     */
    public $director;
    /**
     * @var string
     * @Groups("property")
     */
    public $producer;
    /**
     * @var \App\Model\Character[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $characters;
    /**
     * @var \App\Model\Planet[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $planets;
    /**
     * @var \App\Model\Species[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $species;
    /**
     * @var \App\Model\Starship[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $starships;
    /**
     * @var \App\Model\Vehicle[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $vehicles;
    /**
     * @var \DateTime
     * @Groups("property")
     */
    public $releaseDate;
    /** @var \DateTime */
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
