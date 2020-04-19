<?php

namespace TMDB\API\Model;

class MovieMovieIdGetResponse404
{
    /**
     * @var string
     */
    protected $statusMessage;
    /**
     * @var int
     */
    protected $statusCode;

    public function getStatusMessage(): string
    {
        return $this->statusMessage;
    }

    public function setStatusMessage(string $statusMessage): self
    {
        $this->statusMessage = $statusMessage;

        return $this;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function setStatusCode(int $statusCode): self
    {
        $this->statusCode = $statusCode;

        return $this;
    }
}
