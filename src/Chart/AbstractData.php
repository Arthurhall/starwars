<?php

namespace App\Chart;

use App\Converter\StrToNumConverter;
use App\Manager\SwApiManager;

class AbstractData
{
    /**
     * @var SwApiManager
     */
    protected $swApiManager;

    /**
     * @var StrToNumConverter
     */
    protected $strToNumConverter;

    public function setManager(SwApiManager $manager)
    {
        $this->swApiManager = $manager;
    }

    public function setStrToNumConverter(StrToNumConverter $strToNumConverter)
    {
        $this->strToNumConverter = $strToNumConverter;
    }
}
