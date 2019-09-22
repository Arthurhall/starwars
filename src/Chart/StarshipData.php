<?php

namespace App\Chart;

class StarshipData extends AbstractData
{
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
                $price = $this->strToNumConverter->convert($starship->costInCredits);

                if (!$price) {
                    continue;
                }
                $data[] = [
                    'name' => $starship->getName(),
                    'price' => $price,
                    'speed' => $this->strToNumConverter->convert($starship->maxAtmospheringSpeed),
                ];
            }
        } while ($starships->hasNext());

        usort($data, function ($a, $b) {
            return $b['price'] <=> $a['price'];
        });

        return $data;
    }
}
