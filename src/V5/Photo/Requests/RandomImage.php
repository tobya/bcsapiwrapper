<?php

namespace Bcsapi\V5\Photo\Requests;

use Saloon\Enums\Method;

// for caching
// if you wish to use this you must composer require saloonphp/cache-plugin "^3.0"
use Illuminate\Support\Facades\Cache;
use Saloon\CachePlugin\Traits\HasCaching;
use Saloon\CachePlugin\Contracts\Driver;
use Saloon\CachePlugin\Contracts\Cacheable;
use Saloon\CachePlugin\Drivers\LaravelCacheDriver;


class RandomImage extends \Saloon\Http\Request
{
 

    /**
     * The HTTP method of the request
     */
    protected Method $method = Method::GET;


    public function __construct(  
           public ?string  $year,
           public ?string $month,
           public ?string $day,
    )
    {  }


    /**
     * The endpoint for the request
     */
    public function resolveEndpoint(): string
    {
         $apipath =   'api/v2/images/random/';

         $fields = [];
         if ($this->year > -1 ){
            $apipath .= '{year}/';

         }
         if ($this->month > -1 ){
            $apipath .= '{month}/';

         }
         if ($this->day > -1 ){
            $apipath .= '{day}/';

         }

         return str($apipath)->replace(
                                    ['{year}','{year?}','{month}','{month?}','{day}','{day?}'],
                                    [$this->year, $this->year,$this->month, $this->month,$this->day, $this->day]
                              );
    }


}
