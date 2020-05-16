<?php

namespace TMDB\API\Endpoint;

class GetTvShowPopulars extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return '/tv/popular';
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
     * @throws \TMDB\API\Exception\GetTvShowPopularsUnauthorizedException
     * @throws \TMDB\API\Exception\GetTvShowPopularsNotFoundException
     *
     * @return \TMDB\API\Model\TvPopularGetResponse200|null
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && false !== mb_strpos($contentType, 'application/json')) {
            return $serializer->deserialize($body, 'TMDB\\API\\Model\\TvPopularGetResponse200', 'json');
        }
        if (401 === $status && false !== mb_strpos($contentType, 'application/json')) {
            throw new \TMDB\API\Exception\GetTvShowPopularsUnauthorizedException($serializer->deserialize($body, 'TMDB\\API\\Model\\TvPopularGetResponse401', 'json'));
        }
        if (404 === $status && false !== mb_strpos($contentType, 'application/json')) {
            throw new \TMDB\API\Exception\GetTvShowPopularsNotFoundException($serializer->deserialize($body, 'TMDB\\API\\Model\\TvPopularGetResponse404', 'json'));
        }
    }
}
