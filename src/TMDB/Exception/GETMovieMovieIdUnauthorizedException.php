<?php

namespace App\TMDB\Exception;

class GETMovieMovieIdUnauthorizedException extends \RuntimeException implements ClientException
{
    private $movieMovieIdGetResponse401;
    public function __construct(\App\TMDB\Model\MovieMovieIdGetResponse401 $movieMovieIdGetResponse401)
    {
        parent::__construct('', 401);
        $this->movieMovieIdGetResponse401 = $movieMovieIdGetResponse401;
    }
    public function getMovieMovieIdGetResponse401()
    {
        return $this->movieMovieIdGetResponse401;
    }
}