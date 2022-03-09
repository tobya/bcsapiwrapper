<?php


namespace Bcsapi;

use GuzzleHttp\Client as GuzzleHttp;

class BaseApi {
    protected $APIKEY = '';
    protected $APIRootURL = '';
    protected $LastCalledURL = '';
    public $JSONAsArray = true;
    public $Raw = false;


    function __construct($APIRootURL, $APIKEY, $AsArray = false)
    {
        $this->APIKEY = $APIKEY;
        $this->APIRootURL = $APIRootURL;
        $this->JSONAsArray = $AsArray;
    }

    /**
     * Replace all the elements in the url.
     * @param $apipath
     * @param $pathfields
     * @return mixed|string|string[]
     */
    protected function Replacer($apipath, $pathfields) {

        // all requests that have {apikey} in path should have it replaced
        // add it to list of fields to be replaced
        if (isset($this->APIKEY)){
            $pathfields['{apikey}'] = $this->APIKEY;
        }

        foreach ($pathfields as $key => $value) {
            $value = urlencode($value);
            $apipath =  str_replace("$key", $value, $apipath);
        }
        return $apipath;
    }

    /**
     * Call the Api by replacing the url elements.
     * @param $APIPath
     * @param array $APIFields
     * @param array $PostData
     * @return array|mixed|\Psr\Http\Message\StreamInterface
     */
    protected function CallAPI($APIPath, $APIFields = [], $PostData = []) {
        $UrlBlock = $this->Replacer($APIPath, $APIFields);
        return $this->CallURL($UrlBlock, $PostData);
    }

    protected function CallURL($UrlBlock, $PostData = []) {
        $url = $this->BuildURLString($UrlBlock);

        $this->LastCalledURL = $url;

       $guzzleclient = new GuzzleHttp();
        // Only call POST when required.
        if (!empty($PostData)){
            $data = $guzzleclient->post($url, ['form_params' => $PostData])->getBody();
        } else {
            $data = $guzzleclient->get($url)->getBody();
        }

        if ($this->Raw){
            return $data;
        }


        $Info = json_decode($data, $this->JSONAsArray);

         if ($this->JSONAsArray){

                if (is_null( $Info)) { // json decode error
                    $Info = [];
                    $Info['jsonerror'] = json_last_error();
                    $Info['jsonerrormsg'] = json_last_error_msg();
                }

                $Info['url'] = $url;
         } else {

                if (is_null( $Info)) { // json decode error
                    
                    $Info = (object) [];
                    $Info->jsonerror = json_last_error();
                    $Info->jsonerrormsg = json_last_error_msg();
                }

         }

        return $Info;


    }


    public function BuildURLString($UrlBlock){

        if ($this->APIRootURL == ''){
            throw new \Exception("BCS Api URL not found. Please provide in config/bcsapi.php file.", 404);
        }

        return $this->APIRootURL .   $UrlBlock;
    }

    public function LastURL()  {
        return $this->LastCalledURL;
    }

    /**
     * When providing lists of ids to functions they can be 
     * a single id, a csv list of ids, or an array. This
     * takes then all and always returns a string.
     * @param $List
     * @return string
     */
    function StringListtoStringList($List)
    {
        // List may be an array, a csv string or a single item.
        if (!is_array($List)){
            $IDListArray = explode(',',$List );
            // if courseids is just a single item explode returns a string
            if (!is_array($IDListArray)){
                $IDListArray = [$List];
            }
        } else {
            $IDListArray = $List;
        }        
        return  implode(',' ,$IDListArray);
    }
    

    
}

