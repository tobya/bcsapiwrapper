<?php

namespace Bcsapi\V5\Photo\Requests;

use Saloon\Enums\Method;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\CachePlugin\Contracts\Cacheable;


class PurgeCache extends \Saloon\Http\Request
{


    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;


    public function __construct(
    )
    {  }


    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
        return 'api/v2/purgecache';
    }


}
