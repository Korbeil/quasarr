<?php

namespace App\TMDB\Exception;

class GETMovieMovieIdNotFoundException extends \RuntimeException implements ClientException
{
    private $movieMovieIdGetResponse404;
    public function __construct(\App\TMDB\Model\MovieMovieIdGetResponse404 $movieMovieIdGetResponse404)
    {
        parent::__construct('', 404);
        $this->movieMovieIdGetResponse404 = $movieMovieIdGetResponse404;
    }
    public function getMovieMovieIdGetResponse404()
    {
        return $this->movieMovieIdGetResponse404;
    }
}