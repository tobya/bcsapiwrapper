<?php


namespace Bcsapi;


class Subscription extends ApiV4
{


    public function SubscriptionCourseInfo($subscriptioncourseid){


         $apipath =   '/api/v4/subscriptions/subscribercourse/{subscribercourseid}';
         $APIFields = ['{subscribercourseid}' => $subscriptioncourseid];
         return $this->CallAPI($apipath, $APIFields);
    }



   }
