<?php 
 
namespace Bcsapi\Reflectors;

   // use Bcsapi\Traits\CourseTypeConstants;

  class CourseTypeNameRetriever
  {

   //   use CourseTypeConstants;

      public static function ToConstantName($id, $default = 'None')
      {
           $ListOfTypes = [];
                     $ListOfTypes[0] = 'CourseType::SHORT';  // Short
                     $ListOfTypes[1] = 'CourseType::COURSE_12_WEEK';  // 12 Week
                     $ListOfTypes[2] = 'CourseType::AFTERNOON_DEMO';  // Afternoon Demo
                     $ListOfTypes[3] = 'CourseType::LONG_COURSE';  // Long Course
                     $ListOfTypes[4] = 'CourseType::FARM_COURSE';  // Farm Course
                     $ListOfTypes[5] = 'CourseType::PRIVATE_DEMO';  // Private Demo
                     $ListOfTypes[6] = 'CourseType::SPECIAL_EVENT';  // Special Event
                     $ListOfTypes[7] = 'CourseType::SLOW_FOOD_CLASS';  // Slow Food Class
                     $ListOfTypes[8] = 'CourseType::CREDITACCOUNT';  // CreditAccount
                     $ListOfTypes[9] = 'CourseType::NOT_A_COURSE';  // Not a Course
                     $ListOfTypes[10] = 'CourseType::RESERVED';  // Reserved 
                     $ListOfTypes[11] = 'CourseType::WELLNESS_COURSE';  // Wellness Course
                     $ListOfTypes[13] = 'CourseType::NIGHT_CLASS';  // Night Class
                     $ListOfTypes[14] = 'CourseType::X_CURRICULAR';  // X-Curricular
                     $ListOfTypes[20] = 'CourseType::EXTERNAL';  // External
                     $ListOfTypes[21] = 'CourseType::SLOW_FOOD_EVENT';  // Slow Food Event
                     $ListOfTypes[30] = 'CourseType::VIRTUAL';  // Virtual 
                     $ListOfTypes[31] = 'CourseType::V_COOKALONG';  // V Cookalong
                     $ListOfTypes[32] = 'CourseType::STREAM_DEMO';  // Stream Demo
                     $ListOfTypes[33] = 'CourseType::ONLINE_CLASS';  // Online Class
                     $ListOfTypes[34] = 'CourseType::FIRESIDE_CHAT';  // Fireside Chat
                     $ListOfTypes[40] = 'CourseType::SUBSCRIPTION';  // Subscription
                     $ListOfTypes[60] = 'CourseType::VOUCHER_COURSE';  // Voucher Course
                     $ListOfTypes[90] = 'CourseType::WORKEXP';  // WORKEXP
                     $ListOfTypes[100] = 'CourseType::NOTACOURSE';  // NOTACOURSE
                     $ListOfTypes[101] = 'CourseType::ACCOUNTING_UNIT';  // Accounting Unit
                     $ListOfTypes[110] = 'CourseType::PERSON_LIST';  // Person List
                     $ListOfTypes[120] = 'CourseType::GARDEN_TOUR';  // Garden Tour
                     $ListOfTypes[130] = 'CourseType::EVENT';  // Event
                     $ListOfTypes[140] = 'CourseType::RESOURCES';  // RESOURCES
                     $ListOfTypes[141] = 'CourseType::COTTAGE';  // Cottage
                     $ListOfTypes[142] = 'CourseType::KITCHEN_SESSION';  // Kitchen Session
                     $ListOfTypes[200] = 'CourseType::ITEMS';  // ITEMS
                     $ListOfTypes[201] = 'CourseType::CALENDER_ITEM';  // Calender Item
                      if (isset($ListOfTypes[$id])){

          return $ListOfTypes[$id];
            } else {

                return $default;
            }
      }


      public static function ToCourseTypeName($id, $default = 'None')
      {
           $cn = static::ToConstantName($id,$default);
            return Str($cn)->split('::')[1];
      }

  }
