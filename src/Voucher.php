<?php


namespace Bcsapi;




class Voucher extends ApiV4 {

  public function ByCode($VoucherCode, $SecurityCode = null){
     $apipath =   '/{apikey}/vouchers/bycode/{vouchercode}';

    if ($SecurityCode == null){
        list($VoucherCode,$SecurityCode) = $this->splitcodes($VoucherCode);
    }

      $APIFields = ['{vouchercode}' => $VoucherCode];

     if (!is_null($SecurityCode) || (!$SecurityCode == '')){
      $apipath .= '/{securitycode}';
      $APIFields['{securitycode}'] = $SecurityCode;
     }
    $all = $this->CallAPI($apipath, $APIFields);

    return $all;
}


    /**
     * takes a string representing a voucher code ro a voucher code and a security code and tries
     * to split them. Makes best guess.
     * @param $Code
     * @return array|\Illuminate\Support\Collection
     */
    public function splitcodes($Code){
      $Code = trim($Code);
      if (\Illuminate\Support\Str::contains($Code,'/')){
          $items = collect( explode('/', $Code));
      } else  if (\Illuminate\Support\Str::contains($Code,'\\')){
          $items = collect( explode('\\', $Code));
      } else  if (\Illuminate\Support\Str::contains($Code,' ')){
          $items = collect( explode(' ', $Code));
      } else  if (\Illuminate\Support\Str::contains($Code,'-')){
          $items = collect( explode(' ', $Code));
      } else {
          // no split
          return [$Code,null];
      }



    // if only one item it must be code not security code
        $items =$items->map(function($item){
              return trim($item);
          })->filter();

      if ($items->count() == 1){
          $items[] = null;
      }
      return $items;

    }
}
