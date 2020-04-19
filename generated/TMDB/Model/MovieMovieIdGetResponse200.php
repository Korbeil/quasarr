<?php

namespace TMDB\API\Model;

class MovieMovieIdGetResponse200
{
    /**
     * @var bool
     */
    protected $adult;
    /**
     * @var string|null
     */
    protected $backdropPath;
    /**
     * @var int
     */
    protected $budget;
    /**
     * @var MovieMovieIdGetResponse200GenresItem[]
     */
    protected $genres;
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $originalLanguage;
    /**
     * @var string
     */
    protected $originalTitle;
    /**
     * @var float
     */
    protected $popularity;
    /**
     * @var string|null
     */
    protected $posterPath;
    /**
     * @var MovieMovieIdGetResponse200ProductionCompaniesItem[]
     */
    protected $productionCompanies;
    /**
     * @var MovieMovieIdGetResponse200ProductionCountriesItem[]
     */
    protected $productionCountries;
    /**
     * @var \DateTime
     */
    protected $releaseDate;
    /**
     * @var int
     */
    protected $revenue;
    /**
     * @var MovieMovieIdGetResponse200SpokenLanguagesItem[]
     */
    protected $spokenLanguages;
    /**
     * @var string
     */
    protected $status;
    /**
     * @var string
     */
    protected $title;
    /**
     * @var bool
     */
    protected $video;
    /**
     * @var float
     */
    protected $voteAverage;
    /**
     * @var int
     */
    protected $voteCount;

    public function getAdult(): bool
    {
        return $this->adult;
    }

    public function setAdult(bool $adult): self
    {
        $this->adult = $adult;

        return $this;
    }

    public function getBackdropPath(): ?string
    {
        return $this->backdropPath;
    }

    public function setBackdropPath(?string $backdropPath): self
    {
        $this->backdropPath = $backdropPath;

        return $this;
    }

    public function getBudget(): int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): self
    {
        $this->budget = $budget;

        return $this;
    }

    /**
     * @return MovieMovieIdGetResponse200GenresItem[]
     */
    public function getGenres(): array
    {
        return $this->genres;
    }

    /**
     * @param MovieMovieIdGetResponse200GenresItem[] $genres
     */
    public function setGenres(array $genres): self
    {
        $this->genres = $genres;

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

    public function getOriginalLanguage(): string
    {
        return $this->originalLanguage;
    }

    public function setOriginalLanguage(string $originalLanguage): self
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    public function getOriginalTitle(): string
    {
        return $this->originalTitle;
    }

    public function setOriginalTitle(string $originalTitle): self
    {
        $this->originalTitle = $originalTitle;

        return $this;
    }

    public function getPopularity(): float
    {
        return $this->popularity;
    }

    public function setPopularity(float $popularity): self
    {
        $this->popularity = $popularity;

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

    /**
     * @return MovieMovieIdGetResponse200ProductionCompaniesItem[]
     */
    public function getProductionCompanies(): array
    {
        return $this->productionCompanies;
    }

    /**
     * @param MovieMovieIdGetResponse200ProductionCompaniesItem[] $productionCompanies
     */
    public function setProductionCompanies(array $productionCompanies): self
    {
        $this->productionCompanies = $productionCompanies;

        return $this;
    }

    /**
     * @return MovieMovieIdGetResponse200ProductionCountriesItem[]
     */
    public function getProductionCountries(): array
    {
        return $this->productionCountries;
    }

    /**
     * @param MovieMovieIdGetResponse200ProductionCountriesItem[] $productionCountries
     */
    public function setProductionCountries(array $productionCountries): self
    {
        $this->productionCountries = $productionCountries;

        return $this;
    }

    public function getReleaseDate(): \DateTime
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(\DateTime $releaseDate): self
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getRevenue(): int
    {
        return $this->revenue;
    }

    public function setRevenue(int $revenue): self
    {
        $this->revenue = $revenue;

        return $this;
    }

    /**
     * @return MovieMovieIdGetResponse200SpokenLanguagesItem[]
     */
    public function getSpokenLanguages(): array
    {
        return $this->spokenLanguages;
    }

    /**
     * @param MovieMovieIdGetResponse200SpokenLanguagesItem[] $spokenLanguages
     */
    public function setSpokenLanguages(array $spokenLanguages): self
    {
        $this->spokenLanguages = $spokenLanguages;

        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getVideo(): bool
    {
        return $this->video;
    }

    public function setVideo(bool $video): self
    {
        $this->video = $video;

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
