<?php

namespace Bcsapi\Facades;



/**
 *  @method static Voucher Voucher()
 *  @method static Course Course()
 *  @method static Student Student()
 *  @method static DemoPhoto DemoPhoto()
 *  @method static Store Store()
 *  @method static Recipe Recipe()
 *  @method static Subscription Subscription()
 *  @method static Subscriber Subscriber()
 *  @method static Subscription Subscription()
 *  @method static MediaItems MediaItems()

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
