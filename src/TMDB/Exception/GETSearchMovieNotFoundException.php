<?php

namespace App\TMDB\Exception;

class GETSearchMovieNotFoundException extends \RuntimeException implements ClientException
{
    private $searchMovieGetResponse404;
    public function __construct(\App\TMDB\Model\SearchMovieGetResponse404 $searchMovieGetResponse404)
    {
        parent::__construct('', 404);
        $this->searchMovieGetResponse404 = $searchMovieGetResponse404;
    }
    public function getSearchMovieGetResponse404()
    {
        return $this->searchMovieGetResponse404;
    }
}