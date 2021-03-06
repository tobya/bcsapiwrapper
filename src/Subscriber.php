<?php


namespace Bcsapi;


class Subscriber extends ApiV4
{


    Public function ActivateBooking($BookingID){
         $apipath =   '/api/v4/subscriptions/booking/{bookingid}/activate';
         $APIFields = ['{bookingid}' => $BookingID];
         return $this->CallAPI($apipath, $APIFields);
    }


    public function SubscriberDetails($IndividualID){
        $apipath =  '/api/v4/subscriber/details/{individualid}';
        $APIFields = ['{individualid}' => $IndividualID];
        return $this->CallAPI($apipath,$APIFields);

        }

    public function CourseActive($IndividualID, $CourseID)
    {
        $apipath = '/api/v4/subscribers/student/{individualid}/activefor/{courseid}';
        $APIFields = ['{individualid}' => $IndividualID, '{courseid}' => $CourseID];
        return $this->CallAPI($apipath, $APIFields);
    }


    public function CoursesAvailable($IndividualID, $Count = 10){


        $apipath = "/api/v4/subscriptions/courselinks/student/{individualid}/available/{count}";
        $APIFields = ['{individualid}' => $IndividualID, '{count}' => $Count];
        return $this->CallAPI($apipath, $APIFields);


    }
    public function CoursesUpcoming($IndividualID, $Count = 10){

        $apipath = "/api/v4/subscriptions/courselinks/student/{individualid}/upcoming";
        $APIFields = ['{individualid}' => $IndividualID];
        return $this->CallAPI($apipath, $APIFields);


    }





   }
