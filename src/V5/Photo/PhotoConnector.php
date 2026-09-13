<?php

namespace Bcsapi\V5\Photo;

use Spatie\Url\Url;
use Saloon\Http\Connector;
use Saloon\Traits\Plugins\AcceptsJson;

class PhotoConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        $host = config('bcsapi.v5.demophoto.url', null);

        if (empty($host)){
          throw new \Exception('No host provided. Please set bcsapi.v5.demophoto.url');
        }

        return (string) Url::fromString($host)->withPath('/');
    }

    /**
     * Default headers for every request
     */
    protected function defaultHeaders(): array
    {
        return [];
    }

    /**
     * Default HTTP client options
     */
    protected function defaultConfig(): array
    {
        return [];
    }
}
