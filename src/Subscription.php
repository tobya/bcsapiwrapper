<?php


namespace Bcsapi;


class Subscription extends ApiV4
{


    public function SubscriptionCourseInfo($subscriptioncourseid){


         $apipath =   '/api/v4/subscriptions/subscribercourse/{subscribercourseid}';
         $APIFields = ['{subscribercourseid}' => $subscriptioncourseid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function MainSubscriptionStreams(){
      $apipath =   '/v4/subscriptions/2/streams/';
         $APIFields = [];
         return $this->CallAPI($apipath, $APIFields);
    }



   }
