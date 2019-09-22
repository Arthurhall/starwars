<?php

namespace App\Chart;

class PlanetData extends AbstractData
{
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
                $population = $this->strToNumConverter->convert($planet->population);

                if (!$population) {
                    continue;
                }
                if (!isset($data[$planet->climate])) {
                    $data[$planet->climate] = [
                        'climate' => $planet->climate,
                        'population' => $population,
                    ];
                } else {
                    $data[$planet->climate]['population'] += $population;
                }
            }
        } while ($planets->hasNext());

        usort($data, function ($a, $b) {
            return $b['population'] <=> $a['population'];
        });

        return array_values($data);
    }
}
