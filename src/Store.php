<?php


namespace Bcsapi;


class Store extends ApiV4
{


    /**
     * @param $key
     * @return array|mixed|object|\Psr\Http\Message\StreamInterface
     */
    public function  GetKeyValue($key) {

         $apipath =   '/{apikey}/keyvalue/get/{key}';
         $APIFields = ['{key}' => $key];
         return $this->CallAPI($apipath, $APIFields);
    }

    /**
     * @param $key
     * @param $data
     * @return array|mixed|object|\Psr\Http\Message\StreamInterface
     */
    public function SetKeyValue($key,$data) {
         $apipath =   '/{apikey}/keyvalue/set/{key}';
         $APIFields = ['{key}' => $key];
         return $this->CallAPI($apipath, $APIFields, ['info' => $data]);
    }

    /**
     * Retrieve data that has been previously set with an identifier token
     * @param $token
     * @return array|mixed|object|\Psr\Http\Message\StreamInterface
     */
    public function getTokenData($token){
         $apipath =   '/{apikey}/token/{token}';
         $APIFields = ['{token}' => $token];
         return $this->CallAPI($apipath, $APIFields);
    }
}
