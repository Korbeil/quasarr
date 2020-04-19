<?php

namespace App\TMDB\Exception;

class GETMoviePopularUnauthorizedException extends \RuntimeException implements ClientException
{
    private $moviePopularGetResponse401;
    public function __construct(\App\TMDB\Model\MoviePopularGetResponse401 $moviePopularGetResponse401)
    {
        parent::__construct('', 401);
        $this->moviePopularGetResponse401 = $moviePopularGetResponse401;
    }
    public function getMoviePopularGetResponse401()
    {
        return $this->moviePopularGetResponse401;
    }
}