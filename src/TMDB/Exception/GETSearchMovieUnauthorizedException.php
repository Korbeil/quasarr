<?php

namespace App\TMDB\Exception;

class GETSearchMovieUnauthorizedException extends \RuntimeException implements ClientException
{
    private $searchMovieGetResponse401;
    public function __construct(\App\TMDB\Model\SearchMovieGetResponse401 $searchMovieGetResponse401)
    {
        parent::__construct('', 401);
        $this->searchMovieGetResponse401 = $searchMovieGetResponse401;
    }
    public function getSearchMovieGetResponse401()
    {
        return $this->searchMovieGetResponse401;
    }
}