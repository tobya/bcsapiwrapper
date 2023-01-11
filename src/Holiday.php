<?php

  namespace Bcsapi;

  use Bcsapi\Facades\BCSApi;
  use Bcsapi\Note;

  class Holiday extends Course
  {


      public function HolidayBetween($fromdate, $todate){

          $holidays = $this->RunningCoursesBetween($fromdate, $todate,  '200,201',true);
          return $holidays;

      }

      public function HolidayNotes($course){
          $Notes = BCSApi::Note()->CourseNotes($course);
          return $Notes;
      }

      public function HolidayNote($courseid){
          $Notes = $this->HolidayNotes($courseid);
          if ($Notes->notes_count > 0){
              return $Notes->notes[0]->Note;
          } else {
              return '';
          }
      }

  }
