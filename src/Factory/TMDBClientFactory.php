<?php

namespace App\Factory;

use TMDB\API\Authentication\ApiKeyAuthentication;
use TMDB\API\Client;

final class TMDBClientFactory
{
    /**
     * @var string
     */
    private $tmdbApiKey;

    public function __construct(string $tmdbApiKey)
    {
        $this->tmdbApiKey = $tmdbApiKey;
    }

    public function create(): Client
    {
        return Client::create(null, new ApiKeyAuthentication($this->tmdbApiKey));
    }
}
