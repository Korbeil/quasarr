<?php

namespace App\TMDB\Normalizer;

use Jane\JsonSchemaRuntime\Normalizer\CheckArray;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\DenormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\DenormalizerInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareInterface;
use Symfony\Component\Serializer\Normalizer\NormalizerAwareTrait;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
class JaneObjectNormalizer implements DenormalizerInterface, NormalizerInterface, DenormalizerAwareInterface, NormalizerAwareInterface
{
    use DenormalizerAwareTrait;
    use NormalizerAwareTrait;
    use CheckArray;
    protected $normalizers = array('App\\TMDB\\Model\\MovieListObject' => 'App\\TMDB\\Normalizer\\MovieListObjectNormalizer', 'App\\TMDB\\Model\\TvListResultObject' => 'App\\TMDB\\Normalizer\\TvListResultObjectNormalizer', 'App\\TMDB\\Model\\SearchMovieGetResponse200' => 'App\\TMDB\\Normalizer\\SearchMovieGetResponse200Normalizer', 'App\\TMDB\\Model\\SearchMovieGetResponse401' => 'App\\TMDB\\Normalizer\\SearchMovieGetResponse401Normalizer', 'App\\TMDB\\Model\\SearchMovieGetResponse404' => 'App\\TMDB\\Normalizer\\SearchMovieGetResponse404Normalizer', 'App\\TMDB\\Model\\SearchTvGetResponse200' => 'App\\TMDB\\Normalizer\\SearchTvGetResponse200Normalizer', 'App\\TMDB\\Model\\SearchTvGetResponse401' => 'App\\TMDB\\Normalizer\\SearchTvGetResponse401Normalizer', 'App\\TMDB\\Model\\SearchTvGetResponse404' => 'App\\TMDB\\Normalizer\\SearchTvGetResponse404Normalizer', 'App\\TMDB\\Model\\MoviePopularGetResponse200' => 'App\\TMDB\\Normalizer\\MoviePopularGetResponse200Normalizer', 'App\\TMDB\\Model\\MoviePopularGetResponse401' => 'App\\TMDB\\Normalizer\\MoviePopularGetResponse401Normalizer', 'App\\TMDB\\Model\\MoviePopularGetResponse404' => 'App\\TMDB\\Normalizer\\MoviePopularGetResponse404Normalizer', 'App\\TMDB\\Model\\TvPopularGetResponse200' => 'App\\TMDB\\Normalizer\\TvPopularGetResponse200Normalizer', 'App\\TMDB\\Model\\TvPopularGetResponse401' => 'App\\TMDB\\Normalizer\\TvPopularGetResponse401Normalizer', 'App\\TMDB\\Model\\TvPopularGetResponse404' => 'App\\TMDB\\Normalizer\\TvPopularGetResponse404Normalizer', 'App\\TMDB\\Model\\MovieMovieIdGetResponse200' => 'App\\TMDB\\Normalizer\\MovieMovieIdGetResponse200Normalizer', 'App\\TMDB\\Model\\MovieMovieIdGetResponse200GenresItem' => 'App\\TMDB\\Normalizer\\MovieMovieIdGetResponse200GenresItemNormalizer', 'App\\TMDB\\Model\\MovieMovieIdGetResponse200ProductionCompaniesItem' => 'App\\TMDB\\Normalizer\\MovieMovieIdGetResponse200ProductionCompaniesItemNormalizer', 'App\\TMDB\\Model\\MovieMovieIdGetResponse200ProductionCountriesItem' => 'App\\TMDB\\Normalizer\\MovieMovieIdGetResponse200ProductionCountriesItemNormalizer', 'App\\TMDB\\Model\\MovieMovieIdGetResponse200SpokenLanguagesItem' => 'App\\TMDB\\Normalizer\\MovieMovieIdGetResponse200SpokenLanguagesItemNormalizer', 'App\\TMDB\\Model\\MovieMovieIdGetResponse401' => 'App\\TMDB\\Normalizer\\MovieMovieIdGetResponse401Normalizer', 'App\\TMDB\\Model\\MovieMovieIdGetResponse404' => 'App\\TMDB\\Normalizer\\MovieMovieIdGetResponse404Normalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse200' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse200Normalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse200CreatedByItem' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse200CreatedByItemNormalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse200GenresItem' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse200GenresItemNormalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse200LastEpisodeToAir' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse200LastEpisodeToAirNormalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse200NetworksItem' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse200NetworksItemNormalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse200ProductionCompaniesItem' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse200ProductionCompaniesItemNormalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse200SeasonsItem' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse200SeasonsItemNormalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse401' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse401Normalizer', 'App\\TMDB\\Model\\TvTvIdGetResponse404' => 'App\\TMDB\\Normalizer\\TvTvIdGetResponse404Normalizer', 'App\\TMDB\\Model\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200' => 'App\\TMDB\\Normalizer\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200Normalizer', 'App\\TMDB\\Model\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200CrewItem' => 'App\\TMDB\\Normalizer\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200CrewItemNormalizer', 'App\\TMDB\\Model\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200GuestStarsItem' => 'App\\TMDB\\Normalizer\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200GuestStarsItemNormalizer', 'App\\TMDB\\Model\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse401' => 'App\\TMDB\\Normalizer\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse401Normalizer', 'App\\TMDB\\Model\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404' => 'App\\TMDB\\Normalizer\\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404Normalizer'), $normalizersCache = array();
    public function supportsDenormalization($data, $type, $format = null)
    {
        return array_key_exists($type, $this->normalizers);
    }
    public function supportsNormalization($data, $format = null)
    {
        return is_object($data) && array_key_exists(get_class($data), $this->normalizers);
    }
    public function normalize($object, $format = null, array $context = array())
    {
        $normalizerClass = $this->normalizers[get_class($object)];
        $normalizer = $this->getNormalizer($normalizerClass);
        return $normalizer->normalize($object, $format, $context);
    }
    public function denormalize($data, $class, $format = null, array $context = array())
    {
        $denormalizerClass = $this->normalizers[$class];
        $denormalizer = $this->getNormalizer($denormalizerClass);
        return $denormalizer->denormalize($data, $class, $format, $context);
    }
    private function getNormalizer(string $normalizerClass)
    {
        return $this->normalizersCache[$normalizerClass] ?? $this->initNormalizer($normalizerClass);
    }
    private function initNormalizer(string $normalizerClass)
    {
        $normalizer = new $normalizerClass();
        $normalizer->setNormalizer($this->normalizer);
        $normalizer->setDenormalizer($this->denormalizer);
        $this->normalizersCache[$normalizerClass] = $normalizer;
        return $normalizer;
    }
}