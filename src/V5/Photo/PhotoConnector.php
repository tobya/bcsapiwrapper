<?php

namespace Bcsapi\V5\Photo;

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
        return config('bcsapi.v2.demophoto.url');
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
