<?php

  namespace Bcsapi;

  class ImageBank extends BaseApi
  {

    protected $token ;

    public function __construct($APIRootURL, $token)
    {
        parent::__construct($APIRootURL,null);
        $this->token = $token;
    }


    public function Store($ImageFileName, $FileNameString = ''){
        $s = fopen($ImageFileName,'r');

        if ($FileNameString == ''){
          $FileNameString =  pathinfo($ImageFileName,PATHINFO_FILENAME);
        }

       $returndata =  \Illuminate\Support\Facades\Http::attach('file', $s )
                                            ->withToken($this->token)
                                            ->post($this->APIRootURL .  '/v1/store',[
                                              'filename' => $FileNameString,
                                            ]);

        return $returndata;
    }
  }