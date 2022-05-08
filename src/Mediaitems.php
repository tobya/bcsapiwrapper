<?php


namespace Bcsapi;


class Mediaitems extends ApiV4
{


    public function forCourse($CourseLinkID){
        $apipath = "/api/v4/courselink/{courselinkid}/mediaitems";
        $APIFields = ['{courselinkid}' => $CourseLinkID];
        return $this->CallAPI($apipath, $APIFields);

    }





   }
