<?php

  namespace Bcsapi;

  use Bcsapi\BaseApi;
use Illuminate\Http\Client\PendingRequest;
  class TelegramChat extends BaseApi
  {

      public function SendMessage($student_id, $message)
      {


            $apipath = '/v1/chats/student/{student_id}/post/message';
            $APIFields = ['{student_id}' => $student_id];

        return $this->CallAPI($apipath, $APIFields,['message' => $message]);
      }

    public function addHeaders(PendingRequest $httpClient)
    {
        return   $httpClient->withToken(config('bcsapi.v4.kitchenbook.token','no-token'))
                            ->acceptJson()
                            ->withHeaders(['v1' => self::class , 'kitchenbook-api-version' => '1']);
    }
  }
