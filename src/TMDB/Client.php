<?php

namespace App\TMDB;

class Client extends \Jane\OpenApiRuntime\Client\Psr18Client
{
    /**
     * Search for movies.
     *
     * @param array $queryParameters {
     *     @var string $query 
     *     @var int $page 
     *     @var int $year 
     *     @var int $primary_release_year 
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \App\TMDB\Exception\GETSearchMovieUnauthorizedException
     * @throws \App\TMDB\Exception\GETSearchMovieNotFoundException
     *
     * @return null|\App\TMDB\Model\SearchMovieGetResponse200|\Psr\Http\Message\ResponseInterface
     */
    public function gETSearchMovie(array $queryParameters = array(), string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\TMDB\Endpoint\GETSearchMovie($queryParameters), $fetch);
    }
    /**
     * Search for a TV show.
     *
     * @param array $queryParameters {
     *     @var string $query 
     *     @var int $page 
     *     @var int $first_air_date_year 
     * }
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \App\TMDB\Exception\GETSearchTvUnauthorizedException
     * @throws \App\TMDB\Exception\GETSearchTvNotFoundException
     *
     * @return null|\App\TMDB\Model\SearchTvGetResponse200|\Psr\Http\Message\ResponseInterface
     */
    public function gETSearchTv(array $queryParameters = array(), string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\TMDB\Endpoint\GETSearchTv($queryParameters), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \App\TMDB\Exception\GETMoviePopularUnauthorizedException
     * @throws \App\TMDB\Exception\GETMoviePopularNotFoundException
     *
     * @return null|\App\TMDB\Model\MoviePopularGetResponse200|\Psr\Http\Message\ResponseInterface
     */
    public function gETMoviePopular(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\TMDB\Endpoint\GETMoviePopular(), $fetch);
    }
    /**
     * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
     * @throws \App\TMDB\Exception\GETTvPopularUnauthorizedException
     * @throws \App\TMDB\Exception\GETTvPopularNotFoundException
     *
     * @return null|\App\TMDB\Model\TvPopularGetResponse200|\Psr\Http\Message\ResponseInterface
     */
    public function gETTvPopular(string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\TMDB\Endpoint\GETTvPopular(), $fetch);
    }
    /**
    * Get the primary information about a movie.
    
    Supports `append_to_response`. Read more about this [here](#docTextSection:JdZq8ctmcxNqyLQjp).
    *
    * @param int $movieId 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \App\TMDB\Exception\GETMovieMovieIdUnauthorizedException
    * @throws \App\TMDB\Exception\GETMovieMovieIdNotFoundException
    *
    * @return null|\App\TMDB\Model\MovieMovieIdGetResponse200|\Psr\Http\Message\ResponseInterface
    */
    public function gETMovieMovieId(int $movieId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\TMDB\Endpoint\GETMovieMovieId($movieId), $fetch);
    }
    /**
    * Get the primary TV show details by id.
    
    Supports `append_to_response`. Read more about this [here](#docTextSection:JdZq8ctmcxNqyLQjp).
    
    #### Recent Changes
    
    | **Date** | **Change** |
    | - | - |
    | July 17, 2018 | We now return `last_episode_to_air` and `next_episode_to_air` fields. |
    | March 12, 2018 | Networks return proper logos and we introduced SVG support. |
    | March 8, 2018 | The `seasons` field now returns the translated names and overviews. |
    *
    * @param int $tvId 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \App\TMDB\Exception\GETTvTvIdUnauthorizedException
    * @throws \App\TMDB\Exception\GETTvTvIdNotFoundException
    *
    * @return null|\App\TMDB\Model\TvTvIdGetResponse200|\Psr\Http\Message\ResponseInterface
    */
    public function gETTvTvId(int $tvId, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\TMDB\Endpoint\GETTvTvId($tvId), $fetch);
    }
    /**
    * Get the TV episode details by id.
    
    Supports `append_to_response`. Read more about this [here](#docTextSection:JdZq8ctmcxNqyLQjp).
    
    #### Recent Changes
    
    | **Date** | **Change** |
    | - | - |
    | June 1, 2018 | Added the [translations](#endpoint:5SFwZar3LkP99QMp7) method. |
    *
    * @param int $tvId 
    * @param int $seasonNumber 
    * @param int $episodeNumber 
    * @param string $fetch Fetch mode to use (can be OBJECT or RESPONSE)
    * @throws \App\TMDB\Exception\GETTvTvIdSeasonSeasonNumberEpisodeEpisodeNumberUnauthorizedException
    * @throws \App\TMDB\Exception\GETTvTvIdSeasonSeasonNumberEpisodeEpisodeNumberNotFoundException
    *
    * @return null|\App\TMDB\Model\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200|\Psr\Http\Message\ResponseInterface
    */
    public function gETTvTvIdSeasonSeasonNumberEpisodeEpisodeNumber(int $tvId, int $seasonNumber, int $episodeNumber, string $fetch = self::FETCH_OBJECT)
    {
        return $this->executePsr7Endpoint(new \App\TMDB\Endpoint\GETTvTvIdSeasonSeasonNumberEpisodeEpisodeNumber($tvId, $seasonNumber, $episodeNumber), $fetch);
    }
    public static function create($httpClient = null, \Jane\OpenApiRuntime\Client\Authentication $authentication = null)
    {
        if (null === $httpClient) {
            $httpClient = \Http\Discovery\Psr18ClientDiscovery::find();
            $plugins = array();
            $uri = \Http\Discovery\Psr17FactoryDiscovery::findUrlFactory()->createUri('https://api.themoviedb.org/3');
            $plugins[] = new \Http\Client\Common\Plugin\AddHostPlugin($uri);
            $plugins[] = new \Http\Client\Common\Plugin\AddPathPlugin($uri);
            if (null !== $authentication) {
                $plugins[] = $authentication->getPlugin();
            }
            $httpClient = new \Http\Client\Common\PluginClient($httpClient, $plugins);
        }
        $requestFactory = \Http\Discovery\Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = \Http\Discovery\Psr17FactoryDiscovery::findStreamFactory();
        $serializer = new \Symfony\Component\Serializer\Serializer(array(new \Symfony\Component\Serializer\Normalizer\ArrayDenormalizer(), new \App\TMDB\Normalizer\JaneObjectNormalizer()), array(new \Symfony\Component\Serializer\Encoder\JsonEncoder(new \Symfony\Component\Serializer\Encoder\JsonEncode(), new \Symfony\Component\Serializer\Encoder\JsonDecode(array('json_decode_associative' => true)))));
        return new static($httpClient, $requestFactory, $serializer, $streamFactory);
    }
}