<?php

  namespace Bcsapi;

  class Telegram extends ApiV4
  {


    public function sendMessage($individualid, $text){
        $apipath = '/api/v1/{individualid}/send/message';
        $apifields = ['{individualid}' => $individualid];
        $postfields = ['message' => $text];
        $this->CallAPI($apipath, $apifields, $postfields);
      }
  }