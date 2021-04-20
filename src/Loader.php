<?php


namespace Bcsapi;


class Loader
{
    public $apiurl;
    public $apikey;

    public function __construct( $apiurl, $apikey){
        $this->apiurl = $apiurl;
        $this->apikey = $apikey;
    }

    public function Voucher(){
     // return  new \BCSVoucherAPI($this->apiurl, $this->apikey, false);
    }

    Public function Course(){
      return new Course($this->apiurl, $this->apikey, false);
    }

    Public function Student(){
      return new Student($this->apiurl, $this->apikey, false);
    }

}
