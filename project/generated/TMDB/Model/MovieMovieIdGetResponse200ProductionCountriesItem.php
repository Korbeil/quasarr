<?php

namespace TMDB\API\Model;

class MovieMovieIdGetResponse200ProductionCountriesItem
{
    /**
     * @var string
     */
    protected $iso31661;
    /**
     * @var string
     */
    protected $name;

    public function getIso31661(): string
    {
        return $this->iso31661;
    }

    public function setIso31661(string $iso31661): self
    {
        $this->iso31661 = $iso31661;

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
}
