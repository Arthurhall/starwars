<?php

namespace App\Serializer;

use App\Manager\SwApiManager;
use App\Model\Character;
use App\Model\Film;
use App\Model\Planet;
use App\Model\Species;
use App\Model\Starship;
use App\Model\Vehicle;
use Symfony\Component\Serializer\Exception\LogicException;
use Symfony\Component\Serializer\Mapping\Factory\ClassMetadataFactoryInterface;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;
use function in_array;

class RelationDenormalizer implements ContextAwareDenormalizerInterface
{
    /**
     * @var SwApiManager
     */
    private $swApiManager;

    /**
     * @var ClassMetadataFactoryInterface
     */
    private $classMetadataFactory;

    /**
     * @param SwApiManager $swApiManager
     */
    public function __construct(SwApiManager $swApiManager, ClassMetadataFactoryInterface $classMetadataFactory)
    {
        $this->swApiManager = $swApiManager;
        $this->classMetadataFactory = $classMetadataFactory;
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
        $method = $this->getEndpointMethod($type);

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
        if (is_array($data) && isset($context['is_collection']) && $context['is_collection']) {
            return false;
        }

        $isSupported = in_array($type, [
            Character::class.'[]',
            Film::class.'[]',
            Planet::class.'[]',
            Species::class.'[]',
            Starship::class.'[]',
            Vehicle::class.'[]',
        ]);

        if (!$isSupported
            && in_array($type, [
                Character::class,
                Film::class,
                Planet::class,
                Species::class,
                Starship::class,
                Vehicle::class,
            ])
            && is_string($data)
        ) {
            $isSupported = true;
        }

        return $isSupported;
    }

    /**
     * @param string $type
     *
     * @return string
     *
     * @throws LogicException
     */
    private function getEndpointMethod(string $type): string
    {
        switch ($type) {
            case Character::class.'[]':
            case Character::class:
                return 'characters';
            case Film::class.'[]':
            case Film::class:
                return 'films';
            case Planet::class.'[]':
            case Planet::class:
                return 'planets';
            case Species::class.'[]':
            case Species::class:
                return 'species';
            case Starship::class.'[]':
            case Starship::class:
                return 'starships';
            case Vehicle::class.'[]':
            case Vehicle::class:
                return 'vehicles';

            default: throw new LogicException(sprintf('No endpoint for type "%s" !', $type));
        }
    }
}