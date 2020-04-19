<?php

namespace TMDB\API\Model;

class TvTvIdGetResponse200CreatedByItem
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
     * @var int
     */
    protected $gender;
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

    public function getGender(): int
    {
        return $this->gender;
    }

    public function setGender(int $gender): self
    {
        $this->gender = $gender;

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
