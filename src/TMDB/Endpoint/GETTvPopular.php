<?php

namespace App\TMDB\Endpoint;

class GETTvPopular extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/tv/popular';
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
     * @throws \App\TMDB\Exception\GETTvPopularUnauthorizedException
     * @throws \App\TMDB\Exception\GETTvPopularNotFoundException
     *
     * @return null|\App\TMDB\Model\TvPopularGetResponse200
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\TMDB\\Model\\TvPopularGetResponse200', 'json');
        }
        if (401 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\TMDB\Exception\GETTvPopularUnauthorizedException($serializer->deserialize($body, 'App\\TMDB\\Model\\TvPopularGetResponse401', 'json'));
        }
        if (404 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\TMDB\Exception\GETTvPopularNotFoundException($serializer->deserialize($body, 'App\\TMDB\\Model\\TvPopularGetResponse404', 'json'));
        }
    }
}