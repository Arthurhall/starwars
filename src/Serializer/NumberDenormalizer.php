<?php

namespace App\Serializer;

use App\Converter\StrToNumConverter;
use Symfony\Component\Serializer\Normalizer\ContextAwareDenormalizerInterface;

class NumberDenormalizer implements ContextAwareDenormalizerInterface
{
    /**
     * @var StrToNumConverter
     */
    private $strToNumConverter;

    public function __construct(StrToNumConverter $strToNum)
    {
        $this->strToNumConverter = $strToNum;
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
        //dd($data, $type, $format, $context);
        return $this->strToNumConverter->convert($data);
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
        return false; //$type == 'int' && is_string($data);
    }
}