<?php

namespace TMDB\API\Model;

class MoviePopularGetResponse200
{
    /**
     * @var int
     */
    protected $page;
    /**
     * @var MovieListObject[]
     */
    protected $results;
    /**
     * @var int
     */
    protected $totalResults;
    /**
     * @var int
     */
    protected $totalPages;

    public function getPage(): int
    {
        return $this->page;
    }

    public function setPage(int $page): self
    {
        $this->page = $page;

        return $this;
    }

    /**
     * @return MovieListObject[]
     */
    public function getResults(): array
    {
        return $this->results;
    }

    /**
     * @param MovieListObject[] $results
     */
    public function setResults(array $results): self
    {
        $this->results = $results;

        return $this;
    }

    public function getTotalResults(): int
    {
        return $this->totalResults;
    }

    public function setTotalResults(int $totalResults): self
    {
        $this->totalResults = $totalResults;

        return $this;
    }

    public function getTotalPages(): int
    {
        return $this->totalPages;
    }

    public function setTotalPages(int $totalPages): self
    {
        $this->totalPages = $totalPages;

        return $this;
    }
}
