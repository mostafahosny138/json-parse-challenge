<?php

namespace App\Utilities;

class FilterBuilder
{

    protected $collection;
    protected $filters=[
        'BalanceFilterClass',
        'CurrencyFilterClass',
        'StatusFilterClass'
    ];
    protected $namespace='App\Utilities\Filter';

    public function __construct($collection)
    {
        $this->collection = $collection;
    }

    public function apply()
    {

        foreach ($this->filters as $name => $value) {

            $class = $this->namespace . "\\{$value}";

            if (! class_exists($class)) {
                continue;
            }
            $this->collection= (new $class($this->collection))->handle(request()->all());

        }

        return $this->collection;

    }

}
