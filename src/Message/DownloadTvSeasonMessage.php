<?php

namespace App\Message;

final class DownloadTvSeasonMessage
{
    private $number;
    private $tvShowId;

    public function __construct(string $number, int $tvShowId)
    {
        $this->number = $number;
        $this->tvShowId = $tvShowId;
    }

    public function getNumber(): string
    {
        return $this->number;
    }

    public function getTvShowId(): int
    {
        return $this->tvShowId;
    }
}
