<?php

namespace App\Chart;

class SpeciesData extends AbstractData
{
    /**
     * @return array
     */
    public function getDataCharacters(): array
    {
        $data = [];
        do {
            if (!isset($species)) {
                $species = $this->swApiManager->species()->index();
            } else {
                $species = $species->getNext();
            }

            foreach ($species as $s) {
                $data[$s->getName()] = [
                    'name' => $s->getName(),
                    'children' => [],
                ];
                foreach ($s->people as $character) {
                    $data[$s->getName()]['children'][] = [
                        'name' => $character->getName(),
                        'value' => 1,
                    ];
                }
            }
        } while ($species->hasNext());

        usort($data, function ($a, $b) {
            return count($b['children']) <=> count($a['children']);
        });

        return array_values($data);
    }
}
