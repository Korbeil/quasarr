<?php

namespace App\TMDB\Exception;

class GETSearchTvNotFoundException extends \RuntimeException implements ClientException
{
    private $searchTvGetResponse404;
    public function __construct(\App\TMDB\Model\SearchTvGetResponse404 $searchTvGetResponse404)
    {
        parent::__construct('', 404);
        $this->searchTvGetResponse404 = $searchTvGetResponse404;
    }
    public function getSearchTvGetResponse404()
    {
        return $this->searchTvGetResponse404;
    }
}