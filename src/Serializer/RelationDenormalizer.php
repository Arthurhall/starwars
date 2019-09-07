<?php

namespace App\Serializer;

use App\Manager\SwApiManager;
use App\Model\Character;
use App\Model\Film;
use App\Model\Planet;
use App\Model\Vehicle;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use function in_array;

class RelationDenormalizer implements ContextAwareDenormalizerInterface
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
     * @param array $data
     * @param string $type
     * @param string $format
     * @param array $context
     *
     * @return array
     */
    public function denormalize($data, $type, $format = null, array $context = [])
    {
        switch ($type) {
            case Character::class.'[]':
                $method = 'characters';
                break;
            case Film::class.'[]':
                $method = 'films';
                break;
            case Planet::class:
                $method = 'planets';
                break;

            default: return;
        }
        if (is_array($data) && substr($type, -2) == '[]') {
            foreach ($data as $key => $url) {
                $data[$key] = $this->swApiManager->{$method}()->setSerializerGroups(['property'])->get($url);
            }
        } elseif (is_string($data)) {
            $data = $this->swApiManager->{$method}()->setSerializerGroups(['property'])->get($data);
        }

        return $data;
    }

    /**
     * @param array $data
     * @param string $type
     * @param string $format
     * @param array $context
     *
     * @return boolean
     */
    public function supportsDenormalization($data, $type, $format = null, array $context = [])
    {
        $isSupported = in_array($type, [
            Character::class.'[]',
            Film::class.'[]',
            Vehicle::class.'[]',
        ]);

        if (!$isSupported && $type == Planet::class && is_string($data)) {
            $isSupported = true;
        }

        return $isSupported;
    }
}