<?php

namespace App\Utilities\Filter;

use App\Contracts\Abstracts\FilterInterface;

class BalanceFilterClass implements FilterInterface
{
    protected $collection;

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function handle($data)
    {

        if (isset($data['balanceMin']) && $data['balanceMax'])
            return  $this->collection->where('amount', '>=', $data['balanceMin'])->where('amount', '<=', $data['balanceMax']);

        return $this->collection;
    }


}
