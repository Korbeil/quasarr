<?php

namespace App\MessageHandler;

use Symfony\Component\HttpClient\HttpClient;
use Symfony\Contracts\HttpClient\HttpClientInterface;

trait JackettAwareTrait
{
    /**
     * @var HttpClientInterface
     */
    protected $jackettClient;

    public function createJackettClient(string $jackettUrl, string $jackettApiKey)
    {
        $this->jackettClient = HttpClient::create([
            'base_uri' => $jackettUrl,
            'query' => [
                'apikey' => $jackettApiKey,
            ],
            'http_version' => '2.0',
        ]);
    }
}
