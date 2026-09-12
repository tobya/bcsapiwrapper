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

class PhotoApi
{

      protected PhotoConnector $connector;
     /**
     * @var null | Request
     */

      private $shouldReturnRequest = false;

      protected $disableCaching = false;

      public function __construct(  )
      {
            $this->connector = new PhotoConnector();
      }


      public function getRequest($toggle = true) : static
      {
          $this->shouldReturnRequest = $toggle;
          return $this;
      }

      public function send(Request $request ) : Response
      {
            return $this->connector->send($request);
      }


      Protected function getRequest_or_SendForResult($request )
      {
            // apply any modifiers
            $request = $this->applymodifiers($request);

            // if getRequest() has been called, don't actually send request to server,
            // just return the request to caller.
            if ($this->shouldReturnRequest){
                return $request;
            }

            return $this->send($request);
      }
            
    /**
        * RandomImage
        * @return Response | RandomImage
        */
        public function RandomImage($year,$month,$day) : Response | RandomImage
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


    



        public function disableCaching($disableCaching = true) : static
        {
            $this->disableCaching = $disableCaching;
            return $this;
        }



      /**
       * Process any modification to Request.
       * @param Request $request
       * @return Response
       */
        protected function applymodifiers(Request $request) : Request
        {
            if ($this->disableCaching){
                if(method_exists($request,'disableCaching'))
                {
                  $request->disableCaching();
                }
            }
            return $request;
        }



}

