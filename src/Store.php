<?php


namespace Bcsapi;


class Store extends BaseApi
{


    public function  GetKeyValue($key) {

         $apipath =   '/{apikey}/keyvalue/get/{key}';
         $APIFields = ['{key}' => $key];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function SetKeyValue($key,$data) {
         $apipath =   '/{apikey}/keyvalue/set/{key}';
         $APIFields = ['{key}' => $key];
         return $this->CallAPI($apipath, $APIFields, ['info' => $data]);
    }
}
