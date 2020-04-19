<?php

namespace App\TMDB\Model;

class MoviePopularGetResponse200
{
    /**
     * 
     *
     * @var int
     */
    protected $page;
    /**
     * 
     *
     * @var MovieListObject[]
     */
    protected $results;
    /**
     * 
     *
     * @var int
     */
    protected $totalResults;
    /**
     * 
     *
     * @var int
     */
    protected $totalPages;
    /**
     * 
     *
     * @return int
     */
    public function getPage() : int
    {
        return $this->page;
    }
    /**
     * 
     *
     * @param int $page
     *
     * @return self
     */
    public function setPage(int $page) : self
    {
        $this->page = $page;
        return $this;
    }
    /**
     * 
     *
     * @return MovieListObject[]
     */
    public function getResults() : array
    {
        return $this->results;
    }
    /**
     * 
     *
     * @param MovieListObject[] $results
     *
     * @return self
     */
    public function setResults(array $results) : self
    {
        $this->results = $results;
        return $this;
    }
    /**
     * 
     *
     * @return int
     */
    public function getTotalResults() : int
    {
        return $this->totalResults;
    }
    /**
     * 
     *
     * @param int $totalResults
     *
     * @return self
     */
    public function setTotalResults(int $totalResults) : self
    {
        $this->totalResults = $totalResults;
        return $this;
    }
    /**
     * 
     *
     * @return int
     */
    public function getTotalPages() : int
    {
        return $this->totalPages;
    }
    /**
     * 
     *
     * @param int $totalPages
     *
     * @return self
     */
    public function setTotalPages(int $totalPages) : self
    {
        $this->totalPages = $totalPages;
        return $this;
    }
}