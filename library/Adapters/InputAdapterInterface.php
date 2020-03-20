<?php
namespace Paginator\Adapters;

interface InputAdapterInterface
{
    public function getTotal();
    public function getRange($offset, $length);
}
