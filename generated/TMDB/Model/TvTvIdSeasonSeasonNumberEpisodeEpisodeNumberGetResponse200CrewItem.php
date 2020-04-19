<?php

namespace TMDB\API\Model;

class TvTvIdSeasonSeasonNumberEpisodeEpisodeNumberGetResponse200CrewItem
{
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $creditId;
    /**
     * @var string
     */
    protected $name;
    /**
     * @var string
     */
    protected $department;
    /**
     * @var string
     */
    protected $job;
    /**
     * @var string|null
     */
    protected $profilePath;

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): self
    {
        $this->id = $id;

        return $this;
    }

    public function getCreditId(): string
    {
        return $this->creditId;
    }

    public function setCreditId(string $creditId): self
    {
        $this->creditId = $creditId;

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

    public function getDepartment(): string
    {
        return $this->department;
    }

    public function setDepartment(string $department): self
    {
        $this->department = $department;

        return $this;
    }

    public function getJob(): string
    {
        return $this->job;
    }

    public function setJob(string $job): self
    {
        $this->job = $job;

        return $this;
    }

    public function getProfilePath(): ?string
    {
        return $this->profilePath;
    }

    public function setProfilePath(?string $profilePath): self
    {
        $this->profilePath = $profilePath;

        return $this;
    }
}
