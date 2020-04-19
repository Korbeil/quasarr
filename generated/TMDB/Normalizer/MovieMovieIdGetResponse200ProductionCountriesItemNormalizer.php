<?php

namespace TMDB\API\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MovieMovieIdGetResponse200ProductionCountriesItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'TMDB\\API\\Model\\MovieMovieIdGetResponse200ProductionCountriesItem' === $type;
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && 'TMDB\\API\\Model\\MovieMovieIdGetResponse200ProductionCountriesItem' === get_class($data);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $object = new \TMDB\API\Model\MovieMovieIdGetResponse200ProductionCountriesItem();
        if (\array_key_exists('iso_3166_1', $data)) {
            $object->setIso31661($data['iso_3166_1']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getIso31661()) {
            $data['iso_3166_1'] = $object->getIso31661();
        }
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }

        return $data;
    }
}
