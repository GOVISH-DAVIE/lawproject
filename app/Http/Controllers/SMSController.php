<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use AfricasTalking\SDK\AfricasTalking;


class SMSController 


{
    //

    public $username = 'smslawfirm'; // use 'sandbox' for development in the test environment
    public $apiKey   = '2b4b409633e07a7590544391b97180b830cfd0ec81ca0df8db8e66df6decfa92'; // use your sandbox app API key for development in the test environment
    public $AT;
    public $sms;
    function  __construct()
    {
        $this->AT   = new AfricasTalking($this->username, $this->apiKey);
        $this->sms  = $this->AT->sms();
    }
    public  function sendSMS($number, $messege)
    {
        // echo 22;
        $result   = $this->sms->send([
            'to'      => $number,
            'message' => $messege
        ]);
        return $result;
    }
}
