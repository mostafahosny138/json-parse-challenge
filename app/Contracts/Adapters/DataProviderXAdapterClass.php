<?php

namespace App\Contracts\Adapters;

use App\Contracts\Abstracts\DataSourceClass;
use App\Enums\StatusCodeEnum;

class DataProviderXAdapterClass extends DataSourceClass
{
    public $provider_name = 'DataProviderX';
    private $statuses =
        [
            StatusCodeEnum::AUTHORISED=>  1,
            StatusCodeEnum::DECLINE=>  2,
            StatusCodeEnum::REFUNDED=>  3,
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
            $parser->parseAsObjects(storage_path("app/jsonData/DataProviderX.json"), function ($item) {
                $this->result->push($this->prepareData($item));
            });

            return $this;
        } catch (\Exception $e) {
            throw $e;
        }

    }


    public function prepareData($item)
    {
        $user   = new \stdClass();

        try {
            $user->id = $item->parentIdentification;
            $user->email = $item->parentEmail;
            $user->amount = $item->parentAmount;
            $user->currency = $item->Currency;
            $user->status = array_search($item->statusCode, $this->statuses);
            $user->created_at = $item->registerationDate;
            $user->provider = $this->provider_name;


        }catch (\Exception $e)
        {

        }

        return $user;

    }




}
