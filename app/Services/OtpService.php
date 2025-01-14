<?php

namespace App\Services;

use Twilio\Rest\Client;

class OtpService
{
    protected $twilio;

    public function __construct()
    {
        $this->twilio = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
    }

    public function sendOtp($phoneNo, $otp)
    {
        $phoneNumber =$phoneNo ;
        // Remove spaces and unwanted characters
        $phoneNumber = preg_replace('/\s+/', '', $phoneNumber);

        // Ensure the number starts with the correct country code
        if (preg_match('/^0/', $phoneNumber)) {
            $phoneNumber = ltrim($phoneNumber, '0');
        }

        if (!preg_match('/^\+/', $phoneNumber)) {
            if (preg_match('/^(3[0-9]{9})$/', $phoneNumber)) {
                $phoneNumber = '+92' . $phoneNumber; // Pakistan
            } elseif (preg_match('/^(9[0-9]{9})$/', $phoneNumber)) {
                $phoneNumber = '+91' . $phoneNumber; // India
            } else {
                throw new \Exception('Invalid phone number format: ' . $phoneNumber);
            }
        }
        $message = "Your OTP code is: $otp";

        return $this->twilio->messages->create(
            $phoneNumber,
            [
                'from' => env('TWILIO_PHONE_NUMBER'),
                'body' => $message,
            ]
        );
    }
}
