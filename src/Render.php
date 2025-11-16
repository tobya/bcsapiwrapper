<?php

namespace Bcsapi;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

/*
 * Render server can simple use its own connection to DocTo.exe or use the DocTo.works api
 * To use Render Server simply leave these two .env variables blank
 * BCSRENDER_V4_DOCTO_APIURL=
 * BCSRENDER_V4_DOCTO_APITOKEN=
 *
 * If these are left blank, Docto.exe will be used.
 *
 * If you set the Docto.Works values, they will be used for any conversions.
 * BCSRENDER_V4_DOCTO_APIURL=http://docto.works/api
 * BCSRENDER_V4_DOCTO_APITOKEN=gPx1pAzDUQ9lGIuZAHaFe85x9egkgPC10gLiqo9271904fe2
 */
class Render extends BaseApi
{
    protected $token ;
    protected $DOCTORENDER_URL ;
    protected $DOCTORENDER_TOKEN ;


    public function __construct($APIRootURL, $token, $DOCTORENDER_URL = null, $DOCTORENDER_TOKEN = null)
    {
        parent::__construct($APIRootURL,null);
        $this->token = $token;
        $this->DOCTORENDER_URL = $DOCTORENDER_URL;
        $this->DOCTORENDER_TOKEN = $DOCTORENDER_TOKEN;

    }

  /**
   * send word doc to be rendered as pdf
   * @param $DocumentFileName
   * @return mixed|string
   */
    public function DocToPdf($DocumentFileName){
        return $this->ConvertDocToFormat($DocumentFileName,'pdf');
    }

    public function DocToHTML($DocumentFileName){
        return $this->ConvertDocToFormat($DocumentFileName,'html');
    }

    public function DocToTXT($DocumentFileName){
        return $this->ConvertDocToFormat($DocumentFileName,'txt');
    }



    public function ConvertDocToFormat($DocumentFileName, $format){
        $s = fopen($DocumentFileName,'r');


        $OutputFilename = $this->safefilename();
        $response = \Illuminate\Support\Facades\Http::attach('file', $s )
                                            ->sink($OutputFilename)
                                            ->withToken($this->DOCTORENDER_TOKEN)
                                            ->post($this->DOCTORENDER_URL .  '/v1/Docto/' . $format);

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
