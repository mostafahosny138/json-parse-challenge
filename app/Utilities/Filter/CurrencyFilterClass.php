<?php

namespace App\Utilities\Filter;

use App\Contracts\Abstracts\FilterInterface;

    class CurrencyFilterClass implements FilterInterface
{
    protected $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }


    function handle($data)
    {

        if (isset($data['currency']))
                return $this->collection->where('currency',$data['currency']);

        return  $this->collection;
    }
}
