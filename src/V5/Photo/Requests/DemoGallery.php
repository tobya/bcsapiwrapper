<?php

namespace Bcsapi\V5\Photo\Requests;

use Saloon\Enums\Method;

// for caching
// if you wish to use this you must
//      composer require saloonphp/cache-plugin "^3.0"
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;


class DemoGallery extends \Saloon\Http\Request   implements Cacheable
{
      // CACHING


       use HasCaching;

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;


    public function __construct(  
           public string $demodate, 
    )
    {  }


    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
         return str('api/v3/gallery/{demodate}')
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
         return new LaravelCacheDriver(Cache::store('file'));
     }

     public function cacheExpiryInSeconds(): int
     {

         $carbon_dd = Carbon::parse($this->demodate);
         if ($carbon_dd->isToday()){
             return 2;
         }

         return 60*60*24*144;
     }

}
