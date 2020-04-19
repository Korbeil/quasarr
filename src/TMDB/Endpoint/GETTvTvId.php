<?php

namespace App\TMDB\Endpoint;

class GETTvTvId extends \Jane\OpenApiRuntime\Client\BaseEndpoint implements \Jane\OpenApiRuntime\Client\Psr7Endpoint
{
    protected $tv_id;
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
    */
    public function __construct(int $tvId)
    {
        $this->tv_id = $tvId;
    }
    use \Jane\OpenApiRuntime\Client\Psr7EndpointTrait;
    public function getMethod() : string
    {
        return 'GET';
    }
    public function getUri() : string
    {
        return str_replace(array('{tv_id}'), array($this->tv_id), '/tv/{tv_id}');
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
     * @throws \App\TMDB\Exception\GETTvTvIdUnauthorizedException
     * @throws \App\TMDB\Exception\GETTvTvIdNotFoundException
     *
     * @return null|\App\TMDB\Model\TvTvIdGetResponse200
     */
    protected function transformResponseBody(string $body, int $status, \Symfony\Component\Serializer\SerializerInterface $serializer, ?string $contentType = null)
    {
        if (200 === $status && mb_strpos($contentType, 'application/json') !== false) {
            return $serializer->deserialize($body, 'App\\TMDB\\Model\\TvTvIdGetResponse200', 'json');
        }
        if (401 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\TMDB\Exception\GETTvTvIdUnauthorizedException($serializer->deserialize($body, 'App\\TMDB\\Model\\TvTvIdGetResponse401', 'json'));
        }
        if (404 === $status && mb_strpos($contentType, 'application/json') !== false) {
            throw new \App\TMDB\Exception\GETTvTvIdNotFoundException($serializer->deserialize($body, 'App\\TMDB\\Model\\TvTvIdGetResponse404', 'json'));
        }
    }
}