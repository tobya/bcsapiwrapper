<?php

  namespace Bcsapi;

  class PersonList extends Course
  {

    public function stafflist($stafflistid = null){

           $apipath =   '/{apikey}/stafflist';

           if ($stafflistid){
               $apipath .= '/' . $stafflistid;
           }

         return $this->CallAPI($apipath, []);
    }



    /**
     * IS the supplied Individual a member of the special staff personlist.
     * @param $individualid
     * @return array|mixed|object|\Psr\Http\Message\StreamInterface
     */
    public function isStaffMember($individualid){
         $apipath =   '/{apikey}/stafflist/ismember/{individualid}';
         $APIFields = ['{individualid}' => $individualid];
         return $this->CallAPI($apipath, $APIFields);
    }

  }
