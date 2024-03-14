<?php

  namespace Bcsapi;

  class User extends ApiV4
  {
    public function get($userid){
          $apipath =   '/v4/users/{userid}';
         $APIFields = ['{userid}' => $userid];
         return $this->CallAPI($apipath, $APIFields);
    }
  }