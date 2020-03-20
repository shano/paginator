<?php

namespace Paginator\Tests;

use PHPUnit\Framework\TestCase;
use Paginator\Adapters\InputAdapterArray;
use Paginator\Paginator;

class BasicArrayPaginatorTest extends TestCase
{
    protected $input;

    public function setUp()
    {
        $this->input = new InputAdapterArray(['alpha', 'beta', 'gamma', 'delta']);
    }

    public function testGetFirstPageElements()
    {
        $perPage = 2;
        $pageNumber = 0;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), ['alpha', 'beta']);
    }

    public function testGetSecondPageElements()
    {
        $perPage = 2;
        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), ['gamma', 'delta']);
    }

    public function testUnfilledPageElements()
    {
        $perPage = 3;
        $pageNumber = 0;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), ['alpha', 'beta', 'gamma']);

        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->elements(), ['delta']);
    }

    public function testCounts()
    {
        $perPage = 2;
        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->pages(), 2);
        $this->assertEquals($pagination->totalElements(), 4);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 2);
        $this->assertEquals($pagination->totalElementsPerPage(), 2);
        $this->assertEquals($pagination->currentPage(), $pageNumber);
    }

    public function testCountsWithUnfilledPageCounts()
    {
        $perPage = 3;
        $pageNumber = 0;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->pages(), 2);
        $this->assertEquals($pagination->totalElements(), 4);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 3);
        $this->assertEquals($pagination->totalElementsPerPage(), 3);
        $this->assertEquals($pagination->currentPage(), $pageNumber);

        $pageNumber = 1;
        $pagination = (new Paginator($this->input, $perPage))->paginate($pageNumber);
        $this->assertEquals($pagination->totalElementsOnCurrentPage(), 1);
        $this->assertEquals($pagination->currentPage(), $pageNumber);
    }
}
