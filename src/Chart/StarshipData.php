<?php

namespace App\Chart;

use App\Manager\SwApiManager;

class StarshipData
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
    public function getDataPrice(): array
    {
        $data = [];
        do {
            if (!isset($starships)) {
                $starships = $this->swApiManager->starships()->setSerializerGroups(['property'])->index();
            } else {
                $starships = $starships->getNext();
            }

            foreach ($starships as $starship) {
                if (!$starship->getPriceInt()) {
                    continue;
                }
                $data[] = [
                    'name' => $starship->getName(),
                    'price' => $starship->getPriceInt(),
                ];
            }
        } while ($starships->hasNext());

        usort($data, function ($a, $b) {
            return $b['price'] <=> $a['price'];
        });

        return $data;
    }
}
