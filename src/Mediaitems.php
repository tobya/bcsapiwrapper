<?php


namespace Bcsapi;


class Mediaitems extends ApiV4
{


    public function forCourselink($CourseLinkID){
        $apipath = "/api/v4/courselink/{courselinkid}/mediaitems";
        $APIFields = ['{courselinkid}' => $CourseLinkID];
        return $this->CallAPI($apipath, $APIFields);

    }

    public function forCourse($CourseID){
        $apipath = "/api/v4/course/{courseid}/mediaitems";
        $APIFields = ['{courseid}' => $CourseID];
        return $this->CallAPI($apipath, $APIFields);

    }





   }
