<?php


namespace Bcsapi;


class Subscription extends BaseApi
{
      function __construct($APIRootURL, $APIKEY)
    {
        parent::__construct($APIRootURL, $APIKEY, false);

    }

    public function SubscriptionCourseInfo($subscriptioncourseid){


         $apipath =   '/api/v3/subscriptions/subscribercourse/{subscribercourseid}';
         $APIFields = ['{subscribercourseid}' => $subscriptioncourseid];
         return $this->CallAPI($apipath, $APIFields);
    }

   }
