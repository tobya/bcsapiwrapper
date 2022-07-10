<?php

namespace Bcsapi;

class Accommodation extends ApiV4
{

    public function forCourse($CourseID){
        $apipath =   '/v4/accommodation/forcourse/{courseid}';
         $APIFields = ['{courseid}' => $CourseID];
         return $this->CallAPI($apipath, $APIFields);
    }
}
