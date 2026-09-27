<?php

namespace App\Http\SaloonIntegrations\Course;

use Spatie\Url\Url;
use Saloon\Http\Connector;
use Saloon\Contracts\Authenticator;
use Saloon\Traits\Plugins\AcceptsJson;
use Saloon\Http\Auth\TokenAuthenticator;

class CourseConnector extends Connector
{
    use AcceptsJson;

    /**
     * The Base URL of the API
     */
    public function resolveBaseUrl(): string
    {
        $host = config('bcsapi.v5.backoffice.url', null);

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

    protected function defaultAuth(): ?Authenticator
    {
      return new TokenAuthenticator( config('bcsapi.v5.backoffice.token', null) );
    }
}
