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
      return  new Voucher($this->apiurl, $this->apikey, false);
    }

    Public function Course(){
      return new Course($this->apiurl, $this->apikey, false);
    }

    /**
     * Return StudentApi Instance
     * @return Student
     */
    Public function Student(){
      return new Student($this->apiurl, $this->apikey, false);
    }

    public function DemoPhoto($DemoPhotoBaseURL = null){
        return new DemoPhoto($DemoPhotoBaseURL);
    }

    public function Store(){
         return new Store($this->apiurl, $this->apikey);
    }

    public function Recipe($RecipeAPIUrl = null, $RecipeAPIKEY = null){
        return new Recipe($RecipeAPIUrl, $RecipeAPIKEY);
    }



}
