<?php

  namespace Bcsapi;

  class Note extends \Bcsapi\ApiV4
  {
    public function  CourseNotes($courseid) {

         $apipath =   '/{apikey}/courses/{courseid}/notes';
         $APIFields = ['{courseid}' => $courseid];
         return $this->CallAPI($apipath, $APIFields);
    }
  }
