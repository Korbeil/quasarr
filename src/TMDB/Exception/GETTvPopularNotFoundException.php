<?php

namespace App\TMDB\Exception;

class GETTvPopularNotFoundException extends \RuntimeException implements ClientException
{
    private $tvPopularGetResponse404;
    public function __construct(\App\TMDB\Model\TvPopularGetResponse404 $tvPopularGetResponse404)
    {
        parent::__construct('', 404);
        $this->tvPopularGetResponse404 = $tvPopularGetResponse404;
    }
    public function getTvPopularGetResponse404()
    {
        return $this->tvPopularGetResponse404;
    }
}