<?php


namespace Bcsapi;


class Subscription extends BaseApi
{


    public function SubscriptionCourseInfo($subscriptioncourseid){


         $apipath =   '/api/v3/subscriptions/subscribercourse/{subscribercourseid}';
         $APIFields = ['{subscribercourseid}' => $subscriptioncourseid];
         return $this->CallAPI($apipath, $APIFields);
    }



   }
