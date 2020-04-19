<?php

namespace App\TMDB\Normalizer;

use Jane\JsonSchemaRuntime\Reference;
use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Exception\InvalidArgumentException;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class TvTvIdGetResponse200NetworksItemNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'App\\TMDB\\Model\\TvTvIdGetResponse200NetworksItem';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'App\\TMDB\\Model\\TvTvIdGetResponse200NetworksItem';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $object = new \App\TMDB\Model\TvTvIdGetResponse200NetworksItem();
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
        }
        if (\array_key_exists('logo_path', $data)) {
            $object->setLogoPath($data['logo_path']);
        }
        if (\array_key_exists('origin_country', $data)) {
            $object->setOriginCountry($data['origin_country']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getId()) {
            $data['id'] = $object->getId();
        }
        if (null !== $object->getLogoPath()) {
            $data['logo_path'] = $object->getLogoPath();
        }
        if (null !== $object->getOriginCountry()) {
            $data['origin_country'] = $object->getOriginCountry();
        }
        return $data;
    }
}