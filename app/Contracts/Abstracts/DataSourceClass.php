<?php

namespace App\Contracts\Abstracts;

use App\Utilities\FilterBuilder;

abstract class DataSourceClass
{
    public $result;

    function __construct()
    {
        $this->result =collect([]);
    }

    abstract function isActiveProvider();
    abstract function  readData();



    function filter()
    {

        $namespace = 'App\Contracts\Filter';
        $filter = new FilterBuilder($this->result);

        return $filter->apply();

    }

}
