<?php

namespace App\Utilities\Filter;

use App\Contracts\Abstracts\FilterInterface;

class StatusFilterClass implements FilterInterface
{
    protected $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    function handle($data)
    {
        if (isset($data['statusCode']))
            return $this->collection->where('status',$data['statusCode']);

        return  $this->collection;


    }
}
