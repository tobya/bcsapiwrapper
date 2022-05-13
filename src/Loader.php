<?php


namespace Bcsapi;



class Loader
{
    public $apiurl;
    public $apikey;
    public $v3apiurl;
    public $v3apikey;
    public $photoapiurl;
    public $recipeapiurl;
    public $recipeapikey;

    public function __construct(){

        $this->apiurl = config('bcsapi.v2.backoffice.url');
        $this->apikey = config('bcsapi.v2.backoffice.key');
        $this->v3apiurl = config('bcsapi.v3.backoffice.url');
        $this->v3apikey = config('bcsapi.v3.backoffice.key');
        $this->v4apiurl = config('bcsapi.v4.backoffice.url');
        $this->photoapiurl = config('bcsapi.v2.demophoto.url');
        $this->recipeapiurl = config('bcsapi.v2.recipe.url');
        $this->recipeapikey = config('bcsapi.v2.recipe.key');

    }

    public function Voucher(){

      return  new Voucher($this->apiurl, $this->apikey);
    }

    Public function Course(){
      return new Course($this->apiurl, $this->apikey);
    }

    /**
     * Return StudentApi Instance
     * @return Student
     */
    Public function Student(){
         if ($this->isBackofficeV4()){
            return new Student($this->v4apiurl, 'v4');
         }
        return new Student($this->apiurl,$this->apikey);
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

    public function Subscription(){
        return new Subscription($this->v3apiurl,$this->v3apikey);
    }

    public function Subscriber(){

        return new Subscriber($this->v3apiurl,$this->v3apikey);

    }

    public function MediaItems(){
        return new Mediaitems($this->v3apiurl, $this->v3apikey);
    }

    public static function isBackofficeV4(){
        if (config('bcsapi.v4.backoffice.url') > ''){
            return true;
        }
        return false;
    }

}
