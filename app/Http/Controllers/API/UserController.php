<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use \App\Contracts\Adapters\{DataProviderXAdapterClass,DataProviderYAdapterClass};
use \App\Contracts\Abstracts\DataSourceClass;
class UserController extends Controller
{

    function __invoke(UserRequest $request)
    {
        $dataX=$this->getData(new DataProviderXAdapterClass);
        $dataY=$this->getData(new DataProviderYAdapterClass);
        $data = $dataX->merge($dataY);

        return response()->json(['users'=>$data],200);
    }

    function getData(DataSourceClass $adapter)
    {

        try {
            return $adapter->isActiveProvider()->readData()->filter();
        }catch (\Exception $e)
        {
            return collect([]);
        }
    }

}
