<?php

namespace Bcsapi\V5\Photo\Requests;

use Saloon\Enums\Method;

use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;


class GalleryListForYear extends \Saloon\Http\Request   implements Cacheable
{


       use HasCaching;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;


    public function __construct(  
           public string $year, 
    )
    {  }


    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
         return str('api/v3/galleries/list/{year}')
                             ->replace(
                                    ['{year}','{year?}'],
                                    [$this->year, $this->year]
                              );
    }

/**
* CACHING
* If you wish to implement caching , you can uncomment these two methods, the implements and has statements above.
*/


    public function resolveCacheDriver(): Driver
     {
         return new LaravelCacheDriver(Cache::store('file'));
     }

     public function cacheExpiryInSeconds(): int
     {
         if ($this->year == now()->year){
            return 60*60*12;
         }

         return 60*60*24*45;  // 45 days


     }

}
