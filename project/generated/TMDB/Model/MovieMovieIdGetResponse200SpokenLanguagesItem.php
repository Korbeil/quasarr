<?php

namespace TMDB\API\Model;

class MovieMovieIdGetResponse200SpokenLanguagesItem
{
    /**
     * @var string
     */
    protected $iso6391;
    /**
     * @var string
     */
    protected $name;

    public function getIso6391(): string
    {
        return $this->iso6391;
    }

    public function setIso6391(string $iso6391): self
    {
        $this->iso6391 = $iso6391;

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
