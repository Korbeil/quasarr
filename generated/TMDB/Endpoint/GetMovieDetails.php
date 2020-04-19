<?php

namespace TMDB\API\Endpoint;

class GetMovieDetails extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    protected $movie_id;

    /**
     * Get the primary information about a movie.
     */
    public function __construct(int $movieId)
    {
        $this->movie_id = $movieId;
    }

    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return str_replace(['{movie_id}'], [$this->movie_id], '/movie/{movie_id}');
    }

    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null): array
    {
        return [[], null];
    }

    public function getExtraHeaders(): array
    {
        return ['Accept' => ['application/json']];
    }

    /**
     * {@inheritdoc}
     *
     * @throws \TMDB\API\Exception\GetMovieDetailsUnauthorizedException
     * @throws \TMDB\API\Exception\GetMovieDetailsNotFoundException
     *
     * @return \TMDB\API\Model\MovieMovieIdGetResponse200|null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && false !== mb_strpos($contentType, 'application/json')) {
            return $serializer->deserialize($body, 'TMDB\\API\\Model\\MovieMovieIdGetResponse200', 'json');
        }
        if (401 === $status && false !== mb_strpos($contentType, 'application/json')) {
            throw new \TMDB\API\Exception\GetMovieDetailsUnauthorizedException($serializer->deserialize($body, 'TMDB\\API\\Model\\MovieMovieIdGetResponse401', 'json'));
        }
        if (404 === $status && false !== mb_strpos($contentType, 'application/json')) {
            throw new \TMDB\API\Exception\GetMovieDetailsNotFoundException($serializer->deserialize($body, 'TMDB\\API\\Model\\MovieMovieIdGetResponse404', 'json'));
        }
    }
}
