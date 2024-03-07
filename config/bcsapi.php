<?php

return [

  'v2' => [
            'backoffice' => [
                'url' => env('BCSBACKOFFICE_APIURL',''),
                'key' => env('BCSBACKOFFICE_APIKEY',''),
            ],
            'demophoto' => [
                'url' => env('DEMOPHOTO_APIURL',''),

            ],
            'recipe' => [
                'url' => env('BCSRECIPE_APIURL',''),
                'key' => env('BCSRECIPE_APIKEY',''),

            ]
        ],
  'v3' => [
            'backoffice' => [
                'url' => env('BCSBACKOFFICE_V3_APIURL',''),
                'key' => env('BCSBACKOFFICE_V3_APIKEY',''),
            ],
        ],

  'v4' => [
            'backoffice' => [
                'url' => env('BCSBACKOFFICE_V4_APIURL'),
                'token' => env('BCSBACKOFFICE_V4_APITOKEN'),
            ],
            'render' => [
                'url' => env('BCSRENDER_V4_APIURL'),
                'token' => env('BCSRENDER_V4_APITOKEN'),
            ],

            'imagebank' => [
                'url' => env('BCSIMAGEBANK_V4_APIURL'),
                'token' => env('BCSIMAGEBANK_V4_APITOKEN'),
            ],
            'secureBooking' => [
                'url' => env('SECUREBOOKING_V4_APIURL'),
                'token' => env('SECUREBOOKING_V4_APITOKEN'),
            ],
        ]

];

/**
 *
 *  These can be copied to your .env file


DEMOPHOTO_APIURL=
BCSRECIPE_APIURL=
BCSRECIPE_APIKEY=

  BCSBACKOFFICE_V4_APIURL=
  BCSBACKOFFICE_V4_APITOKEN=
 BCSRENDER_V4_APIURL=
 BCSRENDER_V4_APITOKEN=

 *
 *
 *
 */