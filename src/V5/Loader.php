<?php

  namespace Bcsapi\V5;

  use Bcsapi\V5\Photo\PhotoApi;
  use Bcsapi\V5\Course\CourseApi;

  class Loader
  {

    public function DemoPhotoApi() : PhotoApi
    {
         return new PhotoApi();
    }
    
    public function CourseApi() : CourseApi
    {
        return new CourseApi();
    }

  }
