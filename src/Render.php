<?php

namespace Bcsapi;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class Render extends BaseApi
{
    protected $token ;

    public function __construct($APIRootURL, $token)
    {
        parent::__construct($APIRootURL,null);
        $this->token = $token;
    }

    public function DocToPdf($DocumentFileName){
        $s = fopen($DocumentFileName,'r');

        $OutputFilename = $this->safefilename();
        \Illuminate\Support\Facades\Http::attach('file', $s )
                                            ->sink($OutputFilename)
                                            ->withToken($this->token)
                                            ->post($this->APIRootURL .  '/v1/Docto/pdf');

        return $OutputFilename;
    }

    public function UrlToPDF($url){
        $OutputFilename = $this->safefilename();
        \Illuminate\Support\Facades\Http::sink( $OutputFilename)
                                            ->withToken($this->token)
                                            ->post($this->APIRootURL .  '/v1/urlto/pdf',['url' => $url]);


        return $OutputFilename;
    }


    public function UrlToPDFWithWaterMark($url, $watermarkset, $watermarkdata){


        $jsondata = json_encode($watermarkdata);
        $OutputFilename = $this->safefilename();
        \Illuminate\Support\Facades\Http::sink($OutputFilename)
            ->withToken($this->token)
            ->post($this->APIRootURL .  '/v1/urlto/pdf/watermark/' . $watermarkset ,
                    [   'url' => $url,
                        'data' => $jsondata ]);


        return $OutputFilename;
    }

    public function WatermarkStoredPDF(string $pdfid, string $watermarkid,array $watermarkdata ){
        $jsondata = json_encode($watermarkdata);
        $OutputFilename = $this->safefilename();
        $url = $this->Replacer($this->APIRootURL .  '/v1/pdf/{pdfuuid}/watermark/{watermarkuuid}' ,['{watermarkuuid}'=>$watermarkid, '{pdfuuid}' => $pdfid]);
        \Illuminate\Support\Facades\Http::sink($OutputFilename)
            ->withToken($this->token)
            ->post($url , ['url' => $url, 'data' => $jsondata ]);

        return $OutputFilename;
    }

    public function safefilename($filename = null){
        Storage::makeDirectory('bcsapi/render');
       if ($filename == null || $filename == '' ){
            return Storage::path('bcsapi/render/' . uniqid() . '.pdf');
       }

       $parts = pathinfo($filename,PATHINFO_ALL);

       if ($parts['dirname'] == '.'){

           return Storage::path('bcsapi/render/' . $filename);
       }

       if ($parts['basename'] == ''){
           return $filename  . '/' .  uniqid() . '.pdf';
       }

       return $filename;
    }
}
