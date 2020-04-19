<?php

namespace App\TMDB\Exception;

class GETTvTvIdSeasonSeasonNumberEpisodeEpisodeNumberNotFoundException extends \RuntimeException implements ClientException
{
    private $tvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404;
    public function __construct(\App\TMDB\Model\TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404 $tvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404)
    {
        parent::__construct('', 404);
        $this->tvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404 = $tvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404;
    }
    public function getTvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404()
    {
        return $this->tvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse404;
    }
}