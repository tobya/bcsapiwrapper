<?php


namespace Bcsapi\V5\Photo;



 use Bcsapi\V5\Photo\PhotoConnector;
   use Bcsapi\V5\Photo\Requests\RandomImage;
   use Bcsapi\V5\Photo\Requests\GalleryListForYear;
   use Bcsapi\V5\Photo\Requests\AlbumListForYear;
   use Bcsapi\V5\Photo\Requests\RecentAlbum;
   use Bcsapi\V5\Photo\Requests\DemoGallery;
   use Bcsapi\V5\Photo\Requests\PurgeCache;
 
 use Saloon\Traits\Plugins\AcceptsJson;
 use Saloon\Http\Response;
 use Saloon\Http\Request;

// Client library must
//      composer require tobya/saloonfire


class PhotoApi extends \Tobya\SaloonFire\SaloonFire
{

     /**
     * @var PhotoConnector $connector
     */
     protected $connector;



      public function __construct(  )
      {
            $this->connector = new PhotoConnector();
      }



            
        /**
        * RandomImage
        * @return Response | RandomImage
        */
        public function RandomImage($year = null,$month = null,$day = null) : Response | RandomImage
        {

            $request = new RandomImage($year,$month,$day);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * GalleryListForYear
        * @return Response | GalleryListForYear
        */
        public function GalleryListForYear($year) : Response | GalleryListForYear
        {

            $request = new GalleryListForYear($year);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * AlbumListForYear
        * @return Response | AlbumListForYear
        */
        public function AlbumListForYear($year) : Response | AlbumListForYear
        {

            $request = new AlbumListForYear($year);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * RecentAlbum
        * @return Response | RecentAlbum
        */
        public function RecentAlbum() : Response | RecentAlbum
        {

            $request = new RecentAlbum();

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * DemoGallery
        * @return Response | DemoGallery
        */
        public function DemoGallery($demodate) : Response | DemoGallery
        {

            $request = new DemoGallery($demodate);

            return $this->getRequest_or_SendForResult($request);

        }


            
        /**
        * PurgeCache
        * @return Response | PurgeCache
        */
        public function PurgeCache() : Response | PurgeCache
        {

            $request = new PurgeCache();

            return $this->getRequest_or_SendForResult($request);

        }


    





}

