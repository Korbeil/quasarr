<?php

namespace App\TMDB\Exception;

class GETMoviePopularNotFoundException extends \RuntimeException implements ClientException
{
    private $moviePopularGetResponse404;
    public function __construct(\App\TMDB\Model\MoviePopularGetResponse404 $moviePopularGetResponse404)
    {
        parent::__construct('', 404);
        $this->moviePopularGetResponse404 = $moviePopularGetResponse404;
    }
    public function getMoviePopularGetResponse404()
    {
        return $this->moviePopularGetResponse404;
    }
}