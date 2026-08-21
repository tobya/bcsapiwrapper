<?php

namespace Bcsapi\V5\Photo\Requests;

use Saloon\Enums\Method;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;


class DemoGallery extends \Saloon\Http\Request   implements Cacheable
{
      // to use  caching uncomment lines and methods and some changes xxx
       use HasCaching;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;


    public function __construct(
           public string $demodate,
    )
    {

    }


    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
         return str('api/v2/gallery/{demodate}')
                             ->replace(
                                    ['{demodate}','{demodate?}'],
                                    [$this->demodate, $this->demodate]
                              );
    }

/**
* CACHING
*/


    public function resolveCacheDriver(): Driver
     {
         return new LaravelCacheDriver(Cache::store(config('cache.default')));
     }

     public function cacheExpiryInSeconds(): int
     {

         $carbon_dd = Carbon::parse($this->demodate);
         if ($carbon_dd->isToday()){
             return 2;
         }

         return 33300;
     }

}
