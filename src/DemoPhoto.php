<?php


namespace Bcsapi;


class DemoPhoto extends BaseApi
{
 function __construct($APIRootURL)
    {
        $this->APIRootURL = $APIRootURL;
        $this->JSONAsArray = false;
    }

    // This function needs to be deleted, it is named wrong, it doesnt
    // return images it returns galleries
    public function  AllImages() {

         $apipath =   '/all';

         $res = $this->CallAPI($apipath);

         $res['depreciated_message'] = 'calls to function AllImages() will be removed.  Does not return Images';
         return $res;
    }

    // Return all Galleries from PhotoaPI.  Should be cached so fast.
    public function  AllGalleries() {

         $apipath =   '/allconvertzen';
         return $this->CallAPI($apipath);
    }

    /*
        Return a list of Pathids with their corresponding Gallerypaths.
    */
    public function  ListtoGalleryPathURL() {

         $apipath =   '/gallerypathurls';
         return $this->CallAPI($apipath);
    }


    // Returns 1 random image from all galleries and all images.
    public function RandomImage($Year = -1, $Month = -1, $Day = -1) {
         $apipath =   '/images/random/';
         $fields = [];
         if ($Year > -1 ){
            $apipath .= '{year}/';
            $fields['{year}'] = $Year;
         }
         if ($Month > -1 ){
            $apipath .= '{Month}/';
            $fields['{Month}'] = $Month;
         }
         if ($Day > -1 ){
            $apipath .= '{Day}/';
            $fields['{Day}'] = $Day;
         }

         return $this->CallAPI($apipath, $fields);
    }


    public function DemoPhotosInfo($DemoDate, $cached = true){
        if ($cached){
            $apipath = '/gallery/{demodate}';
        } else {
            $apipath = '/gallery/{demodate}/nocache';
        }

        $Fields = ['{demodate}' => $DemoDate];
         return $this->CallAPI($apipath, $Fields);
    }

    public function DemoPhotoByTemplate_Raw($DemoDate, $template = null){
        $apipath = '/gallery/{demodate}/html';
        $Fields = ['{demodate}' => $DemoDate];
        if ($template){
            $apipath = '/gallery/{demodate}/html/{template}';
            $Fields['{template}'] = $template;
        }

        $this->Raw = true;
       $RawData = $this->CallAPI($apipath, $Fields);
       $this->Raw = false;
       return $RawData;
    }

    public function PurgeCache() {
         $apipath =   '/purgecache/';
         return $this->CallAPI($apipath);
    }
}