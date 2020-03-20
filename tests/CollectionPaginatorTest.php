<?php

namespace Paginator\Tests;

use Paginator\Adapters\InputAdapterCollection;
use Paginator\Paginator;

class CollectionPaginatorTest extends BasicArrayPaginatorTest
{
    protected $input;

    public function setUp()
    {
        $this->input = new InputAdapterCollection(
            new \ArrayObject(['alpha', 'beta', 'gamma', 'delta', 'epsilon', 'zeta', 'eta'])
        );
    }

    public function testGetFirstPageElements()
    {
        $perPage = 3;
        $pageNumber = 0;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), new \ArrayObject(['alpha', 'beta', 'gamma']));
    }

    public function testGetSecondPageElements()
    {
        $perPage = 3;
        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), new \ArrayObject(['delta', 'epsilon', 'zeta']));
    }

    public function testUnfilledPageElements()
    {
        $perPage = 4;
        $pageNumber = 0;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), new \ArrayObject(['alpha', 'beta', 'gamma', 'delta']));

        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), new \ArrayObject(['epsilon', 'zeta', 'eta']));
    }

    public function testCounts()
    {
        $perPage = 2;
        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->pages(), 4);
        $this->assertEquals($pagination->totalElements(), 7);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 2);
        $this->assertEquals($pagination->totalElementsPerPage(), 2);
        $this->assertEquals($pagination->currentPage(), $pageNumber);
    }

    public function testCountsWithUnfilledPageCounts()
    {
        $perPage = 2;
        $pageNumber = 2;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->pages(), 4);
        $this->assertEquals($pagination->totalElements(), 7);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 2);
        $this->assertEquals($pagination->totalElementsPerPage(), 2);
        $this->assertEquals($pagination->currentPage(), $pageNumber);

        $pageNumber = 3;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 1);
        $this->assertEquals($pagination->currentPage(), $pageNumber);
    }
}
