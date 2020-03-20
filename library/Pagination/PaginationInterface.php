<?php

namespace Paginator\Pagination;

interface PaginationInterface
{
    public function elements();
    public function currentPage();
    public function pages();
    public function totalElements();
    public function totalElementsOnCurrentPage();
    public function totalElementsPerPage();
}
