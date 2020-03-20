<?php

namespace Paginator\Tests;

use Illuminate\Support\Collection;

use Paginator\Adapters\InputAdapterIlluminate;
use Paginator\Paginator;

class IlluminateCollectionPaginatorTest extends BasicArrayPaginatorTest
{
    protected $input;

    public function setUp()
    {
        $this->input = new InputAdapterIlluminate(
            new Collection(['alpha', 'beta', 'gamma', 'delta', 'epsilon', 'zeta', 'eta', 'theta', 'iota'])
        );
    }

    public function testGetFirstPageElements()
    {
        $perPage = 2;
        $pageNumber = 0;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), new Collection(['alpha', 'beta']));
    }

    public function testGetSecondPageElements()
    {
        $perPage = 2;
        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), new Collection(['gamma', 'delta']));
    }

    public function testUnfilledPageElements()
    {
        $perPage = 5;
        $pageNumber = 0;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), new Collection(['alpha', 'beta', 'gamma', 'delta', 'epsilon']));

        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), new Collection(['zeta', 'eta', 'theta', 'iota']));
    }

    public function testCounts()
    {
        $perPage = 2;
        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->pages(), 5);
        $this->assertEquals($pagination->totalElements(), 9);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 2);
        $this->assertEquals($pagination->totalElementsPerPage(), 2);
        $this->assertEquals($pagination->currentPage(), $pageNumber);
    }

    public function testCountsWithUnfilledPageCounts()
    {
        $perPage = 5;
        $pageNumber = 0;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->pages(), 2);
        $this->assertEquals($pagination->totalElements(), 9);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 5);
        $this->assertEquals($pagination->totalElementsPerPage(), 5);
        $this->assertEquals($pagination->currentPage(), $pageNumber);

        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 4);
        $this->assertEquals($pagination->currentPage(), $pageNumber);
    }
}
