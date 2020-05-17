<?php

namespace Quasarr\Message;

final class DownloadTvEpisodeMessage
{
    private $tvShowId;
    private $tvSeasonId;
    private $tvEpisodeNumber;

    public function __construct(int $tvShowId, int $tvSeasonId, int $tvEpisodeNumber)
    {
        $this->tvShowId = $tvShowId;
        $this->tvSeasonId = $tvSeasonId;
        $this->tvEpisodeNumber = $tvEpisodeNumber;
    }

    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }

    public function getTvSeasonId(): int
    {
        return $this->tvSeasonId;
    }

    public function getTvEpisodeNumber(): int
    {
        return $this->tvEpisodeNumber;
    }
}
