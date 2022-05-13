<?php


namespace Bcsapi;


class Course extends ApiV4
{
    public function  CourseInfo($courseid) {

         $apipath =   '/{apikey}/course/{courseid}';
         $APIFields = ['{courseid}' => $courseid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function CourseBookings($courseid) {

         $apipath =   '/{apikey}/course/{courseid}/bookings';
         $APIFields = [ '{courseid}' => $courseid];
         return $this->CallAPI($apipath, $APIFields);
    }
    
    public function CourseBookingsCounts($courseid) {
        if (is_array($courseid)){
            $courseid = implode(',',$courseid);
        }
         $apipath =   '/{apikey}/course/{courseid}/bookings/counts';
         $APIFields = [ '{courseid}' => $courseid];
         return $this->CallAPI($apipath, $APIFields);
    }
    

    public function CourseDescription($courseid) {
        $apipath =   '/{apikey}/course/{courseid}/description';
        $APIFields = [ '{courseid}' => $courseid];
        return $this->CallAPI($apipath, $APIFields);
    }

    public function AllCourseDates($courseid) {
        $apipath =   '/{apikey}/course/{courseid}/dates';
        $APIFields = [ '{courseid}' => $courseid];
        return $this->CallAPI($apipath, $APIFields);
    }

    public function RunningCourses($onDate = 'today', $coursetypes = '0,1') {

        $courseTypelist = $this->StringListtoStringList($coursetypes);
        
         $apipath =   '/{apikey}/courses/running/{coursedate}/{coursetypes}';
         $APIFields = [ '{coursedate}' => $onDate,
                        '{coursetypes}' => $courseTypelist];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function RunningCoursesBetween($fromdate, $todate, $coursetypes='0,1', $IncludeIfStartBefore = false ) 
    {
        $courseTypelist = $this->StringListtoStringList($coursetypes);
        
        $apipath =   '/{apikey}/courses/running/{fromdate}/{todate}/{coursetypes}?IncludeIfStartBefore=' . $IncludeIfStartBefore;
         $APIFields = [ 
                         '{fromdate}' => $fromdate,
                         '{todate}' => $todate,
                        '{coursetypes}' => $courseTypelist,
                        '{IncludeIfStartBefore}' => $IncludeIfStartBefore,           
                        ];
         return $this->CallAPI($apipath, $APIFields);       
        
    }
    
    

    public function AllRunningEvents($onDate = 'today') {
        return $this->RunningCourses($onDate, 'All');
    }

    Public function CourseStreamInfo($courseid){
        $apipath = "/{apikey}/course/{courseid}/courselinks";
        $APIFields = ['{courseid}' => $courseid];
        return $this->CallAPI($apipath, $APIFields);
    }




    //---------------------------------------------------------------

    // Given a Course and a Week Day combination - will return the date.
    function CourseWeekDate($CourseID, $Week, $DayofWeek){
        $Dates = $this->AllCourseDates($CourseID) ;

        foreach ($Dates->days as $key => $D) {
            # code...
            if ($D->week == $Week){
                if ($D->Day == $DayofWeek){
                    return $D->Date;
                }
            }
        }
        return false;

    }

    public function ExtraCourseInfo($courseid)
    {
         $apipath = "/{apikey}/course/{courseid}/extrainfo";
        $APIFields = ['{courseid}' => $courseid];
        return $this->CallAPI($apipath, $APIFields);       
    }

    public function DailySheet($date)
    {
         $apipath = "/{apikey}/dailysheet/day/{date}";
        $APIFields = ['{date}' => $date];
        return $this->CallAPI($apipath, $APIFields);         
    }
    public function WeeklySheet($date)
    {
         $apipath = "/{apikey}/dailysheet/week/{date}";
        $APIFields = ['{date}' => $date];
        return $this->CallAPI($apipath, $APIFields);         
    }

}
