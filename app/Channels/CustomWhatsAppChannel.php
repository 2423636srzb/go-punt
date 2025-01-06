<?php

namespace App\Channels;

use Twilio\Rest\Client;

class CustomWhatsAppChannel
{
    public function send($notifiable, \Illuminate\Notifications\Notification $notification)
    {
        $otp = $notification->otp;

        // Twilio logic to send WhatsApp message
        $client = new Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $client->messages->create(
            'whatsapp:' . $notifiable->phone_number, // Recipient's phone number
            [
                'from' => env('TWILIO_WHATSAPP_NUMBER'),
                'body' => "Your OTP code is: {$otp}",
            ]
        );
    }
}
