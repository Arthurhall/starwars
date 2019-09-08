<?php

namespace App\Model;

use DateTime;
use Symfony\Component\Serializer\Annotation\MaxDepth;
use Symfony\Component\Serializer\Annotation\Groups;

abstract class AbstractModel
{
    /**
     * @var DateTime
     * @Groups("property")
     */
    public $created;
    /**
     * @var DateTime
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

    public function getCreated(): DateTime
    {
        return $this->created;
    }

    public function getEdited(): DateTime
    {
        return $this->edited;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setCreated(DateTime $created)
    {
        $this->created = $created;

        return $this;
    }

    public function setEdited(DateTime $edited)
    {
        $this->edited = $edited;

        return $this;
    }

    public function setUrl($url)
    {
        $this->url = $url;

        return $this;
    }
}
