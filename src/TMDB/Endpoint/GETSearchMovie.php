<?php

namespace App\TMDB\Endpoint;

class GETSearchMovie extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
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
     */
    public function __construct(array $queryParameters = array())
    {
        $this->queryParameters = $queryParameters;
    }
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return '/search/movie';
    }
    public function getBody(\Symfony\Component\Serializer\SerializerInterface $serializer, $streamFactory = null) : array
    {
        return array(array(), null);
    }
    public function getExtraHeaders() : array
    {
        return array('Accept' => array('application/json'));
    }
    protected function getQueryOptionsResolver() : \Symfony\Component\OptionsResolver\OptionsResolver
    {
        $optionsResolver = parent::getQueryOptionsResolver();
        $optionsResolver->setDefined(array('query', 'page', 'year', 'primary_release_year'));
        $optionsResolver->setRequired(array('query'));
        $optionsResolver->setDefaults(array());
        $optionsResolver->setAllowedTypes('query', array('string'));
        $optionsResolver->setAllowedTypes('page', array('int'));
        $optionsResolver->setAllowedTypes('year', array('int'));
        $optionsResolver->setAllowedTypes('primary_release_year', array('int'));
        return $optionsResolver;
    }
    /**
     * {@inheritdoc}
     *
     * @throws \App\TMDB\Exception\GETSearchMovieUnauthorizedException
     * @throws \App\TMDB\Exception\GETSearchMovieNotFoundException
     *
     * @return null|\App\TMDB\Model\SearchMovieGetResponse200
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\TMDB\\Model\\SearchMovieGetResponse200', 'json');
        }
        if (401 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\TMDB\Exception\GETSearchMovieUnauthorizedException($serializer->deserialize($body, 'App\\TMDB\\Model\\SearchMovieGetResponse401', 'json'));
        }
        if (404 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\TMDB\Exception\GETSearchMovieNotFoundException($serializer->deserialize($body, 'App\\TMDB\\Model\\SearchMovieGetResponse404', 'json'));
        }
    }
}