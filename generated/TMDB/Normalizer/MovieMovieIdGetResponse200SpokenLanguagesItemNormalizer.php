<?php

namespace TMDB\API\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class MovieMovieIdGetResponse200SpokenLanguagesItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'TMDB\\API\\Model\\MovieMovieIdGetResponse200SpokenLanguagesItem' === $type;
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && 'TMDB\\API\\Model\\MovieMovieIdGetResponse200SpokenLanguagesItem' === get_class($data);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $object = new \TMDB\API\Model\MovieMovieIdGetResponse200SpokenLanguagesItem();
        if (\array_key_exists('iso_639_1', $data)) {
            $object->setIso6391($data['iso_639_1']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getIso6391()) {
            $data['iso_639_1'] = $object->getIso6391();
        }
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }

        return $data;
    }
}
