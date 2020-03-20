<?php
namespace Paginator\Adapters;

class InputAdapterCollection implements InputAdapterInterface
{
    private $collection;

    public function __construct(\ArrayObject $collection)
    {
        $this->collection = $collection;
    }

    public function getRange($offset, $length)
    {
        // TODO This is really, really bad for memory, optimise this
        return new \ArrayObject(array_slice($this->collection->getArrayCopy(), $offset, $length));
    }
    
    public function getTotal()
    {
        return $this->collection->count();
    }
}
