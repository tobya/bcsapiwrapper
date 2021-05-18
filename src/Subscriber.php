<?php


namespace Bcsapi;


class Subscriber extends BaseApi
{
      function __construct($APIRootURL, $APIKEY)
    {
        parent::__construct($APIRootURL, $APIKEY, false);

    }

    Public function ActivateBooking($BookingID){

         $apipath =   '/api/v3/subscriptions/booking/{bookingid}/activate';
         $APIFields = ['{bookingid}' => $BookingID];
         return $this->CallAPI($apipath, $APIFields);
    }





    public function SubscriberDetails($IndividualID){
        $apipath =  '/api/v3/subscriber/details/{individualid}';
        $APIFields = ['{individualid}' => $IndividualID];
        return $this->CallAPI($apipath,$APIFields);
        }

   }
