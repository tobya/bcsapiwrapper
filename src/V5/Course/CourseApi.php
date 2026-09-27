<?php


namespace Bcsapi\V5\Course;



 use Bcsapi\V5\Course\CourseConnector;
   use Bcsapi\V5\Course\Requests\CoursesRunning;
   use Bcsapi\V5\Course\Requests\CoursesRunningOnDate;
   use Bcsapi\V5\Course\Requests\CoursesRunningBetween;
   use Bcsapi\V5\Course\Requests\SearchCourse;
   use Bcsapi\V5\Course\Requests\CourseListForYear;
   use Bcsapi\V5\Course\Requests\CourseDetails;
   use Bcsapi\V5\Course\Requests\CourseBookings;
   use Bcsapi\V5\Course\Requests\CourseBookingsCounts;
   use Bcsapi\V5\Course\Requests\CourseDescription;
   use Bcsapi\V5\Course\Requests\AllCourseDates;
 
 use Saloon\Traits\Plugins\AcceptsJson;
 use Saloon\Http\Response;
 use Saloon\Http\Request;

// Client library must
//      composer require tobya/saloonfire


class CourseApi extends \Tobya\SaloonFire\SaloonFire
{

     /**
     * @var CourseConnector $connector
     */
     protected $connector;




      public function __construct(  )
      {
            $this->connector = new CourseConnector();
      }



            
        /**
        * CoursesRunning
        * @return Response | CoursesRunning
        */
        public function CoursesRunning() : Response | CoursesRunning
        {

            $request = new CoursesRunning();

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * CoursesRunningOnDate
        * @return Response | CoursesRunningOnDate
        */
        public function CoursesRunningOnDate($coursedate) : Response | CoursesRunningOnDate
        {

            $request = new CoursesRunningOnDate($coursedate);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * CoursesRunningBetween
        * @return Response | CoursesRunningBetween
        */
        public function CoursesRunningBetween($fromdate,$todate,$coursetypes) : Response | CoursesRunningBetween
        {

            $request = new CoursesRunningBetween($fromdate,$todate,$coursetypes);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * SearchCourse
        * @return Response | SearchCourse
        */
        public function SearchCourse($searchvalue) : Response | SearchCourse
        {

            $request = new SearchCourse($searchvalue);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * CourseListForYear
        * @return Response | CourseListForYear
        */
        public function CourseListForYear($year) : Response | CourseListForYear
        {

            $request = new CourseListForYear($year);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * CourseDetails
        * @return Response | CourseDetails
        */
        public function CourseDetails($course) : Response | CourseDetails
        {

            $request = new CourseDetails($course);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * CourseBookings
        * @return Response | CourseBookings
        */
        public function CourseBookings($course) : Response | CourseBookings
        {

            $request = new CourseBookings($course);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * CourseBookingsCounts
        * @return Response | CourseBookingsCounts
        */
        public function CourseBookingsCounts($courseid) : Response | CourseBookingsCounts
        {

            $request = new CourseBookingsCounts($courseid);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * CourseDescription
        * @return Response | CourseDescription
        */
        public function CourseDescription($courseid) : Response | CourseDescription
        {

            $request = new CourseDescription($courseid);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * AllCourseDates
        * @return Response | AllCourseDates
        */
        public function AllCourseDates($course) : Response | AllCourseDates
        {

            $request = new AllCourseDates($course);

            return $this->getRequest_or_SendForResult($request);

        }


    






}

