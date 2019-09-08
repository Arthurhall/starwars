<?php

namespace App\Model;

use DateTime;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Film extends AbstractModel
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
     * @var Character[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $characters;
    /**
     * @var Planet[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $planets;
    /**
     * @var Species[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $species;
    /**
     * @var Starship[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $starships;
    /**
     * @var Vehicle[]
     * @MaxDepth(1)
     * @Groups("relation")
     */
    public $vehicles;
    /**
     * @var DateTime
     * @Groups("property")
     */
    public $releaseDate;

    public function getName()
    {
        return sprintf('%s. %s', $this->episodeId, $this->title);
    }

    public function getSubName()
    {
        return ($this->releaseDate instanceof DateTime) ? $this->releaseDate->format('d/m/Y') : $this->releaseDate;
    }
}
