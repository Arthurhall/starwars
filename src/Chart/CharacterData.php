<?php

namespace App\Chart;

use App\Manager\SwApiManager;
use App\Model\Character;

class CharacterData
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
                if (!$character->getBirthYearInt() || !$character->getHeightInt() || !$character->getMassInt()) {
                    continue;
                }
                if (!isset($data[$character->gender])) {
                    $data[$character->gender] = [
                        'label' => $character->gender,
                        'data' => [$this->getData($character)],
                    ];
                } else {
                    $data[$character->gender]['data'][] = $this->getData($character);
                }
            }
        } while ($characters->hasNext());

        return array_values($data);
    }

    /**
     * @param Character $character
     * @return array
     */
    private function getData(Character $character)
    {
        return [
            'x' => $character->getBirthYearInt(),
            'y' => $character->getHeightInt(),
            'r' => $character->getMassInt(),
            'label' => $character->name,
        ];
    }
}
