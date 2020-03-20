<?php
namespace Paginator\Adapters;

use Illuminate\Support\Collection;

class InputAdapterIlluminate implements InputAdapterInterface
{
    private $illuminateCollection;

    public function __construct(Collection $collection)
    {
        $this->illuminateCollection = $collection;
    }

    public function getRange($offset, $length)
    {
        return $this->illuminateCollection->slice($offset, $length)->values();
    }
    
    public function getTotal()
    {
        return $this->illuminateCollection->count();
    }
}
