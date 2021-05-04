<?php


namespace Bcsapi;



class Loader
{
    public $apiurl;
    public $apikey;
    public $photoapiurl;
    public $recipeapiurl;
    public $recipeapikey;

    public function __construct(){

        $this->apiurl = config('bcsapi.v2.backoffice.url');
        $this->apikey = config('bcsapi.v2.backoffice.key');
        $this->photoapiurl = config('bcsapi.v2.demophoto.url');
        $this->recipeapiurl = config('bcsapi.v2.recipe.url');
        $this->recipeapikey = config('bcsapi.v2.recipe.key');
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

    public function DemoPhoto(){
        return new DemoPhoto($this->photoapiurl);
    }

    public function Store(){
         return new Store($this->apiurl, $this->apikey);
    }

    public function Recipe(){
        return new Recipe($this->recipeapiurl,$this->recipeapikey);
    }



}
