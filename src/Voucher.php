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



    public function splitcodes($Code){
      if (\Illuminate\Support\Str::contains($Code,'/')){
          $items = collect( explode('/', $Code));
      } else  if (\Illuminate\Support\Str::contains($Code,'\\')){
          $items = collect( explode('\\', $Code));
      } else  if (\Illuminate\Support\Str::contains($Code,' ')){
          $items = collect( explode(' ', $Code));
      } else {
          // no split
          return [$Code,null];
      }



        return $items->map(function($item){
              return trim($item);
          });
    }
}
