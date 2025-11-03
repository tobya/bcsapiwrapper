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

  /**
   * send word doc to be rendered as pdf
   * @param $DocumentFileName
   * @return mixed|string
   */
    public function DocToPdf($DocumentFileName){
        return $this->ConvertDocToFormat($DocumentFileName,'pdf');
    }
    public function ConvertDocToFormat($DocumentFileName, $format){
        $s = fopen($DocumentFileName,'r');

        $OutputFilename = $this->safefilename();
        $response = \Illuminate\Support\Facades\Http::attach('file', $s )
                                            ->sink($OutputFilename)
                                            ->withToken($this->token)
                                            ->post($this->APIRootURL .  '/v1/Docto/' . $format);

        if ($response->failed()){
            Log::error('DocToPdf failed');
            Log::error($response->body());
        }

        if ($response->status() != 200){
            Log::error('DocToPdf failed ' . $response->status());
            Log::error($response->body());
        }

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
