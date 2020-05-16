<?php

namespace TMDB\API\Model;

class TvTvIdGetResponse200NetworksItem
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var int
     */
    protected $id;
    /**
     * @var string
     */
    protected $logoPath;
    /**
     * @var string
     */
    protected $originCountry;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

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

    public function getLogoPath(): string
    {
        return $this->logoPath;
    }

    public function setLogoPath(string $logoPath): self
    {
        $this->logoPath = $logoPath;

        return $this;
    }

    public function getOriginCountry(): string
    {
        return $this->originCountry;
    }

    public function setOriginCountry(string $originCountry): self
    {
        $this->originCountry = $originCountry;

        return $this;
    }
}
