<?php


namespace Bcsapi;


class Subscription extends ApiV4
{


    public function SubscriptionCourseInfo($subscriptioncourseid){


         $apipath =   '/api/v4/subscriptions/subscribercourse/{subscribercourseid}';
         $APIFields = ['{subscribercourseid}' => $subscriptioncourseid];
         return $this->CallAPI($apipath, $APIFields);
    }

  /**
   * Get all streams on main subscription.
   * @return array|mixed|object|\Psr\Http\Message\StreamInterface
   */
    public function MainSubscriptionStreams(){
      $apipath =   '/v4/subscriptions/2/streams/';

         $APIFields = [];
         return $this->CallAPI($apipath, $APIFields);
    }


  /**
   * Get all streams available for specific student
   * @param $individualid
   * @return array|mixed|object|\Psr\Http\Message\StreamInterface
   */
    public function SubscriptionStreamsForStudent($individualid){

      $apipath =   '/v4/subscriptions/streams/for/student/{individualid}';

         $APIFields = ['{individualid}'=>$individualid];
         return $this->CallAPI($apipath, $APIFields);
    }



   }
