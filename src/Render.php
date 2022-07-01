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
}