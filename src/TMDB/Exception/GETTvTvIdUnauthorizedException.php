<?php

namespace App\TMDB\Exception;

class GETTvTvIdUnauthorizedException extends \RuntimeException implements ClientException
{
    private $tvTvIdGetResponse401;
    public function __construct(\App\TMDB\Model\TvTvIdGetResponse401 $tvTvIdGetResponse401)
    {
        parent::__construct('', 401);
        $this->tvTvIdGetResponse401 = $tvTvIdGetResponse401;
    }
    public function getTvTvIdGetResponse401()
    {
        return $this->tvTvIdGetResponse401;
    }
}