<?php


namespace Bcsapi;



class Loader
{
    public $apiurl;
    public $apikey;
    public $v3apiurl;
    public $v3apikey;
    public $v4apiurl;
    public $photoapiurl;
    public $recipeapiurl;
    public $recipeapikey;

    /**
     * Pull correct config values for use by api objects.
     */
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

    /**
     * @return Voucher
     */
    public function Voucher(){
         if ($this->isBackofficeV4()){

            return  new Voucher($this->v4apiurl, 'v4');
         }
      return  new Voucher($this->apiurl, $this->apikey);
    }

    /**
     * @return Course
     */
    Public function Course(){
        if ($this->isBackofficeV4()) {
            return new Course($this->v4apiurl, 'v4');
        }
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

    /**
     * @return DemoPhoto
     */
    public function DemoPhoto(){
        return new DemoPhoto($this->photoapiurl);
    }

    /**
     * @return Store
     */
    public function Store(){
        if ($this->isBackofficeV4()) {
            return new Store($this->v4apiurl, 'v4');
        }
            return new Store($this->apiurl, $this->apikey);
    }

    /**
     * @return Recipe
     */
    public function Recipe(){
        return new Recipe($this->recipeapiurl,$this->recipeapikey);
    }

    /**
     * @return Subscription
     */
    public function Subscription(){
        return new Subscription($this->v4apiurl,'v4');
    }

    /**
     * @return Subscriber
     */
    public function Subscriber(){

        return new Subscriber($this->v4apiurl,'v4');

    }

    /**
     * @return Mediaitems
     */
    public function MediaItems(){
        return new Mediaitems($this->v4apiurl, 'v4');
    }

    /**
     * @return bool
     */
    public static function isBackofficeV4(){
        if (config('bcsapi.v4.backoffice.url') > ''){
            return true;
        }
        return false;
    }

}
