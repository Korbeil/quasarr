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
class TvListResultObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    public function supportsDenormalization($data, $type, $format = null)
    {
        return $type === 'App\\TMDB\\Model\\TvListResultObject';
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && get_class($data) === 'App\\TMDB\\Model\\TvListResultObject';
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $object = new \App\TMDB\Model\TvListResultObject();
        if (\array_key_exists('poster_path', $data) && $data['poster_path'] !== null) {
            $object->setPosterPath($data['poster_path']);
        }
        elseif (\array_key_exists('poster_path', $data) && $data['poster_path'] === null) {
            $object->setPosterPath(null);
        }
        if (\array_key_exists('popularity', $data)) {
            $object->setPopularity($data['popularity']);
        }
        if (\array_key_exists('id', $data)) {
            $object->setId($data['id']);
        }
        if (\array_key_exists('backdrop_path', $data) && $data['backdrop_path'] !== null) {
            $object->setBackdropPath($data['backdrop_path']);
        }
        elseif (\array_key_exists('backdrop_path', $data) && $data['backdrop_path'] === null) {
            $object->setBackdropPath(null);
        }
        if (\array_key_exists('vote_average', $data)) {
            $object->setVoteAverage($data['vote_average']);
        }
        if (\array_key_exists('overview', $data)) {
            $object->setOverview($data['overview']);
        }
        if (\array_key_exists('first_air_date', $data) && $data['first_air_date'] !== null) {
            $object->setFirstAirDate(\DateTime::createFromFormat('Y-m-d', $data['first_air_date'])->setTime(0, 0, 0));
        }
        elseif (\array_key_exists('first_air_date', $data) && $data['first_air_date'] === null) {
            $object->setFirstAirDate(null);
        }
        if (\array_key_exists('origin_country', $data)) {
            $values = array();
            foreach ($data['origin_country'] as $value) {
                $values[] = $value;
            }
            $object->setOriginCountry($values);
        }
        if (\array_key_exists('genre_ids', $data)) {
            $values_1 = array();
            foreach ($data['genre_ids'] as $value_1) {
                $values_1[] = $value_1;
            }
            $object->setGenreIds($values_1);
        }
        if (\array_key_exists('original_language', $data)) {
            $object->setOriginalLanguage($data['original_language']);
        }
        if (\array_key_exists('vote_count', $data)) {
            $object->setVoteCount($data['vote_count']);
        }
        if (\array_key_exists('name', $data)) {
            $object->setName($data['name']);
        }
        if (\array_key_exists('original_name', $data)) {
            $object->setOriginalName($data['original_name']);
        }
        return $object;
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $data = array();
        $data['poster_path'] = $object->getPosterPath();
        if (null !== $object->getPopularity()) {
            $data['popularity'] = $object->getPopularity();
        }
        if (null !== $object->getId()) {
            $data['id'] = $object->getId();
        }
        $data['backdrop_path'] = $object->getBackdropPath();
        if (null !== $object->getVoteAverage()) {
            $data['vote_average'] = $object->getVoteAverage();
        }
        if (null !== $object->getOverview()) {
            $data['overview'] = $object->getOverview();
        }
        if (null !== $object->getFirstAirDate()) {
            $data['first_air_date'] = $object->getFirstAirDate()->format('Y-m-d');
        }
        else {
            $data['first_air_date'] = null;
        }
        if (null !== $object->getOriginCountry()) {
            $values = array();
            foreach ($object->getOriginCountry() as $value) {
                $values[] = $value;
            }
            $data['origin_country'] = $values;
        }
        if (null !== $object->getGenreIds()) {
            $values_1 = array();
            foreach ($object->getGenreIds() as $value_1) {
                $values_1[] = $value_1;
            }
            $data['genre_ids'] = $values_1;
        }
        if (null !== $object->getOriginalLanguage()) {
            $data['original_language'] = $object->getOriginalLanguage();
        }
        if (null !== $object->getVoteCount()) {
            $data['vote_count'] = $object->getVoteCount();
        }
        if (null !== $object->getName()) {
            $data['name'] = $object->getName();
        }
        if (null !== $object->getOriginalName()) {
            $data['original_name'] = $object->getOriginalName();
        }
        return $data;
    }
}