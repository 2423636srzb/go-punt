<?php

namespace App\Channels;

use Twilio\Rest\Client;

class CustomWhatsAppChannel
{
    public function send($notifiable, \Illuminate\Notifications\Notification $notification)
    {
        $phoneNumber = $notifiable->phone_number;
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
        $otp = $notification->otp;

        // Twilio logic to send WhatsApp message
        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $client->messages->create(
            'whatsapp:' . $phoneNumber, // Recipient's phone number
            [
                'from' => env('TWILIO_WHATSAPP_NUMBER'),
                'body' => "Your OTP code is: {$otp}",
            ]
        );
    }
}
