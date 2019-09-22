<?php

namespace App\Chart;

use App\Converter\YearToIntConverter;
use App\Model\Character;

class CharacterData extends AbstractData
{
    /**
     * @var YearToIntConverter
     */
    private $yearToIntConverter;

    public function __construct(YearToIntConverter $converter)
    {
        $this->yearToIntConverter = $converter;
    }

    /**
     * @return array
     */
    public function getDataBirthYear(): array
    {
        $data = [];
        do {
            if (!isset($characters)) {
                $characters = $this->swApiManager->characters()->setSerializerGroups(['property'])->index();
            } else {
                $characters = $characters->getNext();
            }

            foreach ($characters as $character) {
                $birthYear = $this->yearToIntConverter->convert($character->birthYear);
                $height = $this->strToNumConverter->convert($character->height);
                $mass = $this->strToNumConverter->convert($character->mass);

                if (!$birthYear || !$height || !$mass) {
                    continue;
                }
                if (!isset($data[$character->gender])) {
                    $data[$character->gender] = [
                        'label' => $character->gender,
                        'data' => [$this->getData($character, $birthYear ,$height ,$mass)],
                    ];
                } else {
                    $data[$character->gender]['data'][] = $this->getData($character, $birthYear ,$height ,$mass);
                }
            }
        } while ($characters->hasNext());

        return array_values($data);
    }

    /**
     * @param Character $character
     * @param float $birthYear
     * @param float $height
     * @param float $mass
     *
     * @return array
     */
    private function getData(Character $character, $birthYear ,$height ,$mass): array
    {
        return [
            'x' => $birthYear,
            'y' => $height,
            'r' => $mass,
            'label' => $character->name,
        ];
    }
}
