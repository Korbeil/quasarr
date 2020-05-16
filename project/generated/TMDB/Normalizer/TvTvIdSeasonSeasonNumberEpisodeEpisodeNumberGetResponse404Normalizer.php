<?php

namespace TMDB\API\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;

class TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404Normalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;

    public function supportsDenormalization($data, $type, $format = null)
    {
        return 'TMDB\\API\\Model\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404' === $type;
    }

    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && 'TMDB\\API\\Model\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404' === get_class($data);
    }

    public function denormalize($data, $class, $format = null, array $context = [])
    {
        $object = new \TMDB\API\Model\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404();
        if (\array_key_exists('status_message', $data)) {
            $object->setStatusMessage($data['status_message']);
        }
        if (\array_key_exists('status_code', $data)) {
            $object->setStatusCode($data['status_code']);
        }

        return $object;
    }

    public function normalize($object, $format = null, array $context = [])
    {
        $data = [];
        if (null !== $object->getStatusMessage()) {
            $data['status_message'] = $object->getStatusMessage();
        }
        if (null !== $object->getStatusCode()) {
            $data['status_code'] = $object->getStatusCode();
        }

        return $data;
    }
}
