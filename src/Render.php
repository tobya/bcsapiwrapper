<?php

namespace Bcsapi;

class Render extends BaseApi
{
    protected $token ;

    public function __construct($APIRootURL, $token)
    {
        parent::__construct($APIRootURL,null);
        $this->token = $token;
    }

    public function DocToPdf($DocumentFileName, $OutputFilename){
        $s = fopen($DocumentFileName,'r');

        \Illuminate\Support\Facades\Http::attach('file', $s )
                                            ->sink($OutputFilename)
                                            ->withToken($this->token)
                                            ->post($this->APIRootURL .  '/v1/Docto/pdf');

        return $OutputFilename;
    }

    public function UrlToPDF($url, $OutputFilename){

        \Illuminate\Support\Facades\Http::sink($OutputFilename)
                                            ->withToken($this->token)
                                            ->post($this->APIRootURL .  '/v1/urlto/pdf',['url' => $url]);


        return $OutputFilename;
    }


    public function UrlToPDFWithWaterMark($url, $watermarkset, $watermarkdata, $OutputFilename){

        $jsondata = json_encode($watermarkdata);

        \Illuminate\Support\Facades\Http::sink($OutputFilename)
                                            ->withToken($this->token)
                                            ->post($this->APIRootURL .  '/v1/urlto/pdf/watermark/' . $watermarkset ,['url' => $url, 'data' => $jsondata ]);


        return $OutputFilename;
    }
}
