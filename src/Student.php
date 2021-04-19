<?php


namespace Bcsapi;


class Student extends BaseApi
{


    public function  BookingInfo($bookingid) {

         $apipath =   '/{apikey}/booking/{bookingid}';
         $APIFields = ['{bookingid}' => $bookingid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function DutyInfo($bookingid, $week){

         $apipath =   '/{apikey}/booking/{bookingid}/rota/week/{week}/details';
         $APIFields = ['{bookingid}' => $bookingid,'{week}' => $week ];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function  StudentBookings($individualid) {
         $apipath =   '/{apikey}/individual/{individualid}/bookings';
         $APIFields = ['{individualid}' => $individualid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function StudentInfoByID($individualid) {
         $apipath =   '/{apikey}/individual/exists/id/{individualid}';
         $APIFields = ['{individualid}' => $individualid];
         return $this->CallAPI($apipath, $APIFields);
    }
    public function StudentInfo($individualid) {
         $apipath =   '/{apikey}/individual/{individualid}';
         $APIFields = ['{individualid}' => $individualid];
         return $this->CallAPI($apipath, $APIFields);
    }

    public function StudentLogin($email, $passwordhash) {
         $apipath =   '/{apikey}/individual/exists/{email}/{passwordhash}';
         $APIFields = ['{email}' => $email, '{passwordhash}' => $passwordhash];
         return $this->CallAPI($apipath, $APIFields);
    }


    public  function findOrAddUserbyEmail($email, $firstname, $lastname)
    {
        $APIPath = '/{apikey}/individual/findorcreate';

        $PostData = ['email' => $email, 'firstname' => $firstname,'lastname' => $lastname];

        return $this->CallAPI($APIPath, [], $PostData);

    }

    public function CreateBooking($IndividualID, $CourseID)  {
            $APIPath = '/{apikey}/individual/{individualid}/bookings/create';
            $APIFields = ['{individualid}' => $IndividualID];
            $PostData = ['courseid' => $CourseID];
            return $this->CallAPI($APIPath, $APIFields,$PostData);


      }

      /*
    Apply payment transactions to a Booking.
    Named functions for most common types, here we have a Stripe Payment.
       */

  public function createStripePayment($BookingID, $AmountasFloat, $Comments)  {
    return $this->CreatePayment($BookingID, $AmountasFloat, $Comments, 'StripeCreditCard');

  }

  public function createVoucherPayment($BookingID, $AmountasFloat, $Comments, $VoucherCode)  {
    return $this->CreatePayment($BookingID, $AmountasFloat, $Comments, 'VoucherPayment',$VoucherCode);

  }


  public function CreatePayment($BookingID, $AmountasFloat, $Comments, $PaymentType, $Reference = null){
          $APIPath = '/{apikey}/bookings/{bookingid}/payment/create';
          $APIFields = ['{bookingid}' => $BookingID];

          // I think maybe I can just pass this straight through!
          $paymentPostData = ['paymenttype' => $PaymentType, 'amount' => $AmountasFloat, 'comments' => $Comments, 'reference' => $Reference];

            return $this->CallAPI($APIPath, $APIFields, $paymentPostData);
  }


    public function AuthKeyLogin($authkey) {
         $apipath =   '/{apikey}/individual/remotelogin/{authkey}';
         $APIFields = ['{authkey}' => $authkey];
         return $this->CallAPI($apipath, $APIFields);
    }

    /**
     * undocumented function
     *
     * @return void
     * @author
     **/
    function createStripeIntentOnBCS($BCSIndividualID,$BCSCourseID,$stripeUserKey,$stripeSetupIntentKey,$stripePaymentMethodKey,$source,$lastAmountCharged){
        $APIPath =   '/{apikey}/stripeintent/add';
        $APIFields = ['{bcsindividualid}' => $BCSIndividualID];
        $stripeIntentPostData = ['bcsindividualid' => $BCSIndividualID,'bcscourseid' => $BCSCourseID,'stripeuserkey' => $stripeUserKey,'stripesetupintentkey' => $stripeSetupIntentKey,'stripepaymentmethodkey' => $stripePaymentMethodKey, 'source' => $source,'lastamountcharged' => $lastAmountCharged ];

        return $this->CallAPI($APIPath, [], $stripeIntentPostData);
    }


    /**
     * note this is for update to  paymentmethod without an actual payment
     *
     * @return void
     * @author
     **/
    public function updateStripeIntentOnBCS($BCSIndividualID,$stripeUserKey,$stripeSetupIntentKey,$stripePaymentMethodKey,$source)
    {
        //$BCSIndividualID,$stripe_id,$setup_intent,$payment_method,$source;

        $APIPath =   '/{apikey}/stripeintent/update';
        $APIFields = ['{bcsindividualid}' => $BCSIndividualID];
        $stripeIntentPostData = ['bcsindividualid' => $BCSIndividualID,'stripeuserkey' => $stripeUserKey,'stripesetupintentkey' => $stripeSetupIntentKey,'stripepaymentmethodkey' => $stripePaymentMethodKey, 'source' => $source];

        return $this->CallAPI($APIPath, [], $stripeIntentPostData);
    }
}
