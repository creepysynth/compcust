<?php

namespace App\Http\Pagination;

use Illuminate\Pagination\LengthAwarePaginator;

class Paginator extends LengthAwarePaginator
{
    /**
     * Create a new paginator instance.
     *
     * @param mixed $items
     * @param int $total
     * @param int $perPage
     * @param int|null $currentPage
     * @param array $options (path, query, fragment, pageName)
     * @return void
     */
    public function __construct($items, $total, $perPage, $currentPage = null, array $options = [])
    {
        parent::__construct($items, $total, $perPage, $currentPage, $options);
    }

    /**
     * Get the start page of the page set formed by onEachSide parameter.
     *
     * @return int
     */
    public function pageFrom()
    {
        if ( ($this->currentPage + $this->onEachSide) > $this->lastPage ) {
            return max($this->lastPage - $this->onEachSide * 2, 1);
        }

        return max($this->currentPage - $this->onEachSide, 1);
    }

    /**
     * Get the end page of the page set formed by onEachSide parameter.
     *
     * @return int
     */
    public function pageTo()
    {
        if ( ($this->currentPage - $this->onEachSide) < 1 ) {
            return min($this->onEachSide * 2 + 1, $this->lastPage);
        }

        return min($this->currentPage + $this->onEachSide, $this->lastPage);
    }

    /**
     * Get the url of the first page.
     *
     * @return string
     */
    public function firstPageUrl()
    {
        return $this->url(1);
    }

    /**
     * Get the url of the last page.
     *
     * @return string
     */
    public function lastPageUrl()
    {
        return $this->url($this->lastPage);
    }

    /**
     * Check if the current page is the last page.
     *
     * @return boolean
     */
    public function onLastPage()
    {
        return $this->currentPage == $this->lastPage;
    }

    /**
     * Check if given page is the current page.
     *
     * @param int $page
     * @return boolean
     */
    public function isCurrentPage(int $page)
    {
        return $this->currentPage == $page;
    }
}
