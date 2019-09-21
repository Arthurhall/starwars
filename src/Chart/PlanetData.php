<?php

namespace App\Chart;

use App\Manager\SwApiManager;
use App\Model\Planet;

class PlanetData
{
    /**
     * @var SwApiManager
     */
    private $swApiManager;

    /**
     * @param SwApiManager $swApiManager
     */
    public function __construct(SwApiManager $swApiManager)
    {
        $this->swApiManager = $swApiManager;
    }

    /**
     * @return array
     */
    public function getDataDiameterPopulation(): array
    {
        $data = [];
        do {
            if (!isset($planets)) {
                $planets = $this->swApiManager->planets()->setSerializerGroups(['property'])->index();
            } else {
                $planets = $planets->getNext();
            }

            foreach ($planets as $planet) {
                if (!$planet->getDiameterInt() || !$planet->getPopulationInt()) {
                    continue;
                }
                if (!isset($data[$planet->climate])) {
                    $data[$planet->climate] = [
                        'label' => $planet->climate,
                        'data' => [$this->getData($planet)],
                    ];
                } else {
                    $data[$planet->climate]['data'][] = $this->getData($planet);
                }
            }
        } while ($planets->hasNext());

        return $data;
    }

    /**
     * @return array
     */
    public function getDataPopulation(): array
    {
        $data = [];
        do {
            if (!isset($planets)) {
                $planets = $this->swApiManager->planets()->setSerializerGroups(['property'])->index();
            } else {
                $planets = $planets->getNext();
            }

            foreach ($planets as $planet) {
                if (!$planet->getPopulationInt()) {
                    continue;
                }
                if (!isset($data[$planet->climate])) {
                    $data[$planet->climate] = [
                        'climate' => $planet->climate,
                        'population' => $planet->getPopulationInt(),
                    ];
                } else {
                    $data[$planet->climate]['population'] += $planet->getPopulationInt();
                }
            }
        } while ($planets->hasNext());

        usort($data, function ($a, $b) {
            return $b['population'] <=> $a['population'];
        });

        return array_values($data);
    }

    /**
     * @param Planet $planet
     * @return array
     */
    private function getData(Planet $planet)
    {
        return [
            'x' => $planet->getPopulationInt(),
            'y' => $planet->getPopulationInt(),
            'r' => $planet->getDiameterInt(),
            'label' => $planet->name,
        ];
    }
}
