<?php
namespace Paginator\Adapters;

class InputAdapterArray implements InputAdapterInterface
{
    private $array;

    public function __construct(array $array)
    {
        $this->array = $array;
    }

    public function getRange($offset, $length)
    {
        return array_slice($this->array, $offset, $length);
    }
    
    public function getTotal()
    {
        return count($this->array);
    }
}
