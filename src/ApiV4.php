<?php

namespace Bcsapi;


use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;

class ApiV4 extends BaseApi
{

    public function addHeaders(PendingRequest $httpClient)
    {
        return   $httpClient->withToken(config('bcsapi.v4.backoffice.token'))
                            ->acceptJson();
    }
}
