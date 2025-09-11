<?php


namespace Bcsapi;

use Bcsapi\Facades\BCSApi;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Spatie\Url\Url;

class BaseApi {
    protected $APIKEY = '';
    protected $APIRootURL = '';
    protected $LastCalledURL = '';
    public $JSONAsArray = true;
    public $Raw = false;
    public $debug = false;
    protected $shouldFakeCall = false;
    protected $fakeCallCallback = null;


    public function FakeCall($callback){
        $this->shouldFakeCall = true;
        $this->fakeCallCallback = $callback;
        return $this;
    }

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
    public function CallAPI($APIPath, $APIFields = [], $PostData = []) {
        $UrlBlock = $this->Replacer($APIPath, $APIFields);
        return $this->CallURL($UrlBlock, $PostData);
    }

    protected function CallURL($UrlBlock, $PostData = []) {
        $url = $this->BuildURLString($UrlBlock);

        $this->LastCalledURL = $url;
        if ($this->shouldFakeCall){
            if (is_callable($this->fakeCallCallback)){
                return call_user_func(  $this->fakeCallCallback);
            }
            return ['status' => 200, 'msg' => 'Fake Call'];
        }
    try{

       $httpclient =   Http::acceptJson();
       $httpclient =  $this->addHeaders($httpclient);
        // Only call POST when required.
        if (!empty($PostData)){
            $response = $httpclient->post($url,$PostData);
            $data = $response->body();

            //$data = $httpclient->post($url, ['form_params' => $PostData, 'headers' => $this->addHeaders([])])->getBody();
        } else {
            $response = $httpclient->get($url);
            //$guzzleResponse = $httpclient->get($url, [ 'headers' => $this->addHeaders([])]);
           // ddd($guzzleResponse);
            //$data = $guzzleResponse->getBody();
            $data = $response->body();
                    }

        if ($this->Raw){
            return $data;
        }

    } catch(\Exception $e){
        return ['status' => 401, 'msg' => $e->getMessage()];
    }

        $Info = json_decode($data, $this->JSONAsArray);
        if (isset($Info->message)){
          if($Info->message == 'Unauthenticated.'){
             throw new \Exception('BCSAPI is Unauthenticated or path does not exist.   ' . $url );
          }
        }
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

         if ($this->debug){
             $Info->debug['url'] = $this->LastURL();
             $Info->debug['version'] = Loader::isBackofficeV4()? 'V4.0': 'V2.0';
         }

         if (BCSApi::ShouldStoreSnapshot()){
            $urlObject = Url::fromString($url);
            $file_snapshot_json = '/bcsapi/' . Str(Url::fromString($this->APIRootURL)->getHost())->slug() .'/snapshots/' .
                                str($urlObject->getPath())->replace('/','-')->replaceStart('-','') . '.json';
            $file_snapshot_url = '/bcsapi/' . Str(Url::fromString($this->APIRootURL)->getHost())->slug() .'/urls/' .
                                str($urlObject->getPath())->replace('/','-')->replaceStart('-','') . '.json' ;

             Storage::disk(BCSApi::SnapshotStore())
                    ->put($file_snapshot_json , $data)         ;

             Storage::disk(BCSApi::SnapshotStore())
                    ->put($file_snapshot_url ,
                        json_encode(
                                    ['url' => $this->LastURL(),
                                     'file' =>   Storage::disk(BCSApi::SnapshotStore())->path($file_snapshot_json)
                            ]
                        )) ;
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

    public function addHeaders(PendingRequest $httpClient) {
        return $httpClient;
    }



}

