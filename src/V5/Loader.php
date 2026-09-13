<?php

  namespace Bcsapi\V5;

  use Bcsapi\V5\Photo\PhotoApi;

  class Loader
  {

    public function DemoPhotoApi() : PhotoApi
    {
         return new PhotoApi();
    }

  }