<?php

namespace Paginator\Pagination;

use Paginator\Adapters\InputAdapterInterface;

class ListPagination implements PaginationInterface
{
    private $adapter;
    private $currentPage;
    private $perPage;

    public function __construct(InputAdapterInterface $adapter, $perPage)
    {
        $this->adapter = $adapter;
        $this->perPage = $perPage;
    }

    /**
     * Sets the current page
     */
    public function setCurrentPage($pageNumber)
    {
        $this->currentPage = $pageNumber;
    }

    /**
     * Returns the elements for the current page
     */
    public function elements()
    {
        return $this->adapter->getRange($this->currentPage * $this->perPage, $this->perPage);
    }

    /**
     * Returns the current page index
     */
    public function currentPage()
    {
        return $this->currentPage;
    }

    /**
     * Returns the total number of pages
     */
    public function pages()
    {
        return ceil($this->adapter->getTotal()/$this->perPage);
    }

    /**
     * Returns the total number of elements
     */
    public function totalElements()
    {
        return $this->adapter->getTotal();
    }

    /**
     * Returns the total number of elements on the current page
     */
    public function totalElementsOnCurrentPage()
    {
        return count($this->elements());
    }

    /**
     * Returns the total number of elements typically per page
     */
    public function totalElementsPerPage()
    {
        return $this->perPage;
    }
}
