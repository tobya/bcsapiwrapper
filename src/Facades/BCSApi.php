<?php

namespace Bcsapi\Facades;



/**
 *  @method static \Bcsapi\Voucher Voucher()
 *  @method static \Bcsapi\Course Course()
 *  @method static \Bcsapi\Student Student()
 *  @method static \Bcsapi\Store Store()
 *  @method static \Bcsapi\Recipe Recipe()
 *  @method static \Bcsapi\Subscription Subscription()
 *  @method static \Bcsapi\Subscriber Subscriber()
 *  @method static \Bcsapi\MediaItems MediaItems()
 *  @method static \Bcsapi\DemoPhoto DemoPhoto()
 *  @method static \Bcsapi\Note Note()
 *  @method static \Bcsapi\Render Render()
 *  @method static \Bcsapi\PersonList PersonList()

 *
 * @see \Bcsapi\Loader
 *
 *
 */

class BCSApi extends  \Illuminate\Support\Facades\Facade {

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'BCSApi'; }

}
