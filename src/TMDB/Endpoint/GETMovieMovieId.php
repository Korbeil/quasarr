<?php

namespace App\TMDB\Endpoint;

class GETMovieMovieId extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    protected $movie_id;
    /**
    * Get the primary information about a movie.
    
    Supports `append_to_response`. Read more about this [here](#docTextSection:JdZq8ctmcxNqyLQjp).
    *
    * @param int $movieId 
    */
    public function __construct(int $movieId)
    {
        $this->movie_id = $movieId;
    }
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{movie_id}'), array($this->movie_id), '/movie/{movie_id}');
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    /**
     * {@inheritdoc}
     *
     * @throws \App\TMDB\Exception\GETMovieMovieIdUnauthorizedException
     * @throws \App\TMDB\Exception\GETMovieMovieIdNotFoundException
     *
     * @return null|\App\TMDB\Model\MovieMovieIdGetResponse200
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\TMDB\\Model\\MovieMovieIdGetResponse200', 'json');
        }
        if (401 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\TMDB\Exception\GETMovieMovieIdUnauthorizedException($serializer->deserialize($body, 'App\\TMDB\\Model\\MovieMovieIdGetResponse401', 'json'));
        }
        if (404 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\TMDB\Exception\GETMovieMovieIdNotFoundException($serializer->deserialize($body, 'App\\TMDB\\Model\\MovieMovieIdGetResponse404', 'json'));
        }
    }
}