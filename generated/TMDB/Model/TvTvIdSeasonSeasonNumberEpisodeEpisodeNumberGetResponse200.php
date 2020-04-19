<?php

namespace TMDB\API\Model;

class TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200
{
    /**
     * @var \DateTime|null
     */
    protected $airDate;
    /**
     * @var TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200CrewItem[]
     */
    protected $crew;
    /**
     * @var int
     */
    protected $episodeNumber;
    /**
     * @var TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200GuestStarsItem[]
     */
    protected $guestStars;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $overview;
    /**
     * @var int
     */
    protected $id;
    /**
     * @var int
     */
    protected $seasonNumber;
    /**
     * @var string|null
     */
    protected $stillPath;
    /**
     * @var float
     */
    protected $voteAverage;
    /**
     * @var int
     */
    protected $voteCount;

    public function getAirDate(): ?\DateTime
    {
        return $this->airDate;
    }

    public function setAirDate(?\DateTime $airDate): self
    {
        $this->airDate = $airDate;

        return $this;
    }

    /**
     * @return TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200CrewItem[]
     */
    public function getCrew(): array
    {
        return $this->crew;
    }

    /**
     * @param TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200CrewItem[] $crew
     */
    public function setCrew(array $crew): self
    {
        $this->crew = $crew;

        return $this;
    }

    public function getEpisodeNumber(): int
    {
        return $this->episodeNumber;
    }

    public function setEpisodeNumber(int $episodeNumber): self
    {
        $this->episodeNumber = $episodeNumber;

        return $this;
    }

    /**
     * @return TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200GuestStarsItem[]
     */
    public function getGuestStars(): array
    {
        return $this->guestStars;
    }

    /**
     * @param TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200GuestStarsItem[] $guestStars
     */
    public function setGuestStars(array $guestStars): self
    {
        $this->guestStars = $guestStars;

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

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

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

    public function getStillPath(): ?string
    {
        return $this->stillPath;
    }

    public function setStillPath(?string $stillPath): self
    {
        $this->stillPath = $stillPath;

        return $this;
    }

    public function getVoteAverage(): float
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(float $voteAverage): self
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    public function getVoteCount(): int
    {
        return $this->voteCount;
    }

    public function setVoteCount(int $voteCount): self
    {
        $this->voteCount = $voteCount;

        return $this;
    }
}
