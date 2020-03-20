<?php
namespace Paginator;

use Paginator\Adapters\InputAdapterInterface;
use Paginator\Pagination\ListPagination;

class Paginator
{
    public function __construct(InputAdapterInterface $input, $perPage)
    {
        $this->pagination = new ListPagination($input, $perPage);
    }

    public function paginate($pageNumber)
    {
        $this->pagination->setCurrentPage($pageNumber);
        return $this->pagination;
    }
}
