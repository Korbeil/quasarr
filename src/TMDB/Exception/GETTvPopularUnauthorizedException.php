<?php

namespace App\TMDB\Exception;

class GETTvPopularUnauthorizedException extends \RuntimeException implements ClientException
{
    private $tvPopularGetResponse401;
    public function __construct(\App\TMDB\Model\TvPopularGetResponse401 $tvPopularGetResponse401)
    {
        parent::__construct('', 401);
        $this->tvPopularGetResponse401 = $tvPopularGetResponse401;
    }
    public function getTvPopularGetResponse401()
    {
        return $this->tvPopularGetResponse401;
    }
}