<?php

namespace TMDB\API\Authentication;

class ApiKeyAuthentication implements \Http\Client\Common\Plugin
{
    private $apiKey;

    public function __construct(string $apiKey)
    {
        $this->{'apiKey'} = $apiKey;
    }

    public function handleRequest(\Psr\Http\Message\RequestInterface $request, callable $next, callable $first): \Http\Promise\Promise
    {
        $uri = $request->getUri();
        $query = $uri->getQuery();
        $params = [];
        parse_str($query, $params);
        $params = array_merge($params, ['api_key' => $this->{'apiKey'}]);
        $query = http_build_query($params, null, '&');
        $uri = $uri->withQuery($query);
        $request = $request->withUri($uri);

        return $next($request);
    }
}
