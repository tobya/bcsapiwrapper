<?php

  namespace Bcsapi\Passport;

  use Illuminate\Support\Facades\Http;

  class User
  {


        public static  function RetrieveRoles ( $User )
    {

        $passportServer =

        $response = Http::withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '. $User->access_token,
        ])->get(config('bcsapi.passport.server').'/api/passport/v1/user/roles');
        return $response;

    }
  }
