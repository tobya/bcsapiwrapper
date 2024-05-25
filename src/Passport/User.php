<?php

  namespace Bcsapi\Passport;

  use Illuminate\Support\Facades\Http;

  class User
  {


        public static  function RetrieveRoles ( $User )
    {

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '. $User->access_token,
        ])->get(env('OAUTH_AUTH_SERVER').'/api/passport/v1/user/roles');
        ray($response->object());
        return $response;

    }
  }
