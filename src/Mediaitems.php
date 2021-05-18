<?php


namespace Bcsapi;


class Mediaitems extends BaseApi
{


    public function forCourse($CourseLinkID){

        $apipath = "/api/v3/courselink/{courselinkid}/mediaitems";
        $APIFields = ['{courselinkid}' => $CourseLinkID];
        return $this->CallAPI($apipath, $APIFields);


    }





   }
