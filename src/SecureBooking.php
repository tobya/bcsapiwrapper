<?php


namespace Bcsapi;

use Illuminate\Support\Str;
use Illuminate\Http\Client\PendingRequest;


class SecureBooking extends BaseApi
{
    public function getNonRetrievedBookings() {

        $apipath =   '/{apikey}/new-bookings/';
        return $this->CallAPI($apipath);
   }

   /**
    * $booking_id is either a single uuid or 
    * , seperated uuids
    */
    public function markBookingRetrieved( $booking_ids) {
        if(!is_array($booking_ids)){
          throw new \Exception('Expecting an array of booking uuuids');
        }
        $apipath =   '/{apikey}/markBookingRetrieved/';
        $PostData = ['booking_ids' => $booking_ids];
        return $this->CallAPI($apipath,[], $PostData);
    }

   /**
     * All Backoffice V4 api calls now require a bearer token, so we add it here.
     * @param PendingRequest $httpClient
     * @return PendingRequest
     */
    public function addHeaders(PendingRequest $httpClient)
    {
        return   $httpClient->withToken(config('bcsapi.v4.secureBooking.token','no-token'))
                            ->acceptJson()
                            ->withHeaders(['v4' => Self::class]);
    }

    /**
     * Make modifications to URL.  V4 strings must always start with /api . Add if required.
     * @param $UrlBlock
     * @return string
     * @throws \Exception
     */
    public function BuildURLString($UrlBlock)
    {
        if (!Str::of($UrlBlock)->startsWith('/api')){
            if (Loader::isBackofficeV4()){
                $UrlBlock = '/api' . $UrlBlock;
        }}
        return parent::BuildURLString($UrlBlock); // TODO: Change the autogenerated stub
    }

}
