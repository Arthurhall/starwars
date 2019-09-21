<?php

namespace App\Model;

use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

class Character extends AbstractModel
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
     * @var Planet
     * @Groups("property")
     */
    public $homeworld;
    /**
     * @var Film[]
     * @MaxDepth(1)
     */
    public $films = [];
    /**
     * @var Species[]
     * @MaxDepth(1)
     */
    public $species = [];
    /**
     * @var Starship[]
     * @MaxDepth(1)
     */
    public $starships = [];
    /**
     * @var Vehicle[]
     * @MaxDepth(1)
     */
    public $vehicles = [];

    public function getName()
    {
        return $this->name;
    }

    public function getSubName()
    {
        return $this->birthYear;
    }

    public function getBirthYearInt()
    {
        if ($this->birthYear == 'unknown') {
            return false;
        }

        preg_match('/^(\d+\.?\d*)(BBY|ABY)$/', $this->birthYear, $matches);
        if (isset($matches[1])) {
            $year = (float) $matches[1];
            if (isset($matches[2]) && $matches[2] == 'BBY') {
                $year *= -1;
            }

            return $year;
        }
    }

    public function getMassInt()
    {
        if ($this->mass == 'unknown') {
            return false;
        }

        return (float) str_replace(',', '', $this->mass);
    }

    public function getHeightInt()
    {
        if ($this->height == 'unknown') {
            return false;
        }

        return (float) str_replace(',', '', $this->height);
    }
}
