<?php

namespace Bcsapi\Facades;





/**

 *  @method static \Bcsapi\V5\Photo\PhotoApi DemoPhotoApi()

 *
 * @see \Bcsapi\Loader
 *
 *
 */

class BCSApiV5 extends  \Illuminate\Support\Facades\Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'BCSApiV5'; }

}
