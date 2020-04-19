<?php

namespace TMDB\API\Model;

class TvTvIdGetResponse200SeasonsItem
{
    /**
     * @var \DateTime|null
     */
    protected $airDate;
    /**
     * @var int
     */
    protected $episodeCount;
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $overview;
    /**
     * @var string|null
     */
    protected $posterPath;
    /**
     * @var int
     */
    protected $seasonNumber;

    public function getAirDate(): ?\DateTime
    {
        return $this->airDate;
    }

    public function setAirDate(?\DateTime $airDate): self
    {
        $this->airDate = $airDate;

        return $this;
    }

    public function getEpisodeCount(): int
    {
        return $this->episodeCount;
    }

    public function setEpisodeCount(int $episodeCount): self
    {
        $this->episodeCount = $episodeCount;

        return $this;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getOverview(): string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): self
    {
        $this->overview = $overview;

        return $this;
    }

    public function getPosterPath(): ?string
    {
        return $this->posterPath;
    }

    public function setPosterPath(?string $posterPath): self
    {
        $this->posterPath = $posterPath;

        return $this;
    }

    public function getSeasonNumber(): int
    {
        return $this->seasonNumber;
    }

    public function setSeasonNumber(int $seasonNumber): self
    {
        $this->seasonNumber = $seasonNumber;

        return $this;
    }
}
