<?php

namespace App\Contracts\Adapters;

use App\Contracts\Abstracts\DataSourceClass;
use App\Enums\StatusCodeEnum;
use Carbon\Carbon;

class DataProviderYAdapterClass extends DataSourceClass
{

    public $provider_name='DataProviderY';
    private $statuses =
        [
            StatusCodeEnum::AUTHORISED=>  100,
            StatusCodeEnum::DECLINE=>  200,
            StatusCodeEnum::REFUNDED=>  300,
        ];



    function isActiveProvider()
    {

        $next= (!request()->has('provider') || (request()->has('provider') && request()->provider == $this->provider_name))
            ? $this:throw new \Exception();
        return $next;

    }


    function readData()
    {
        try {
            $parser = new \JsonCollectionParser\Parser();
            $parser->parseAsObjects(storage_path("app/jsonData/DataProviderY.json"), function ($item)  {
                $this->result->push($this->prepareData($item));
            });

            return $this;
        } catch (\Exception $e) {
            throw $e;
        }

    }


    private function prepareData($item)
    {
        $user   = new \stdClass();

        try {

            $user->id = $item->id;
            $user->email = $item->email;
            $user->amount = $item->balance;
            $user->currency = $item->currency;
            $user->status = array_search($item->status, $this->statuses);
            $user->created_at =str_replace('/','-',$item->created_at) ;
            $user->provider = $this->provider_name;

        }catch (\Exception $e)
        {

        }

        return $user;


    }


}
