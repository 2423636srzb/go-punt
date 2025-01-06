<?php

namespace App\Notifications;

use Illuminate\Notifications\Notification;
use App\Channels\CustomWhatsAppChannel;

class WhatsAppOTPNotification extends Notification
{
    public $otp;  // Make sure this is publicly accessible

    public function __construct($otp)
    {
        $this->otp = $otp;
    }

    public function via($notifiable)
    {
        return ['customWhatsApp'];  // Use custom WhatsApp channel
    }

    public function toCustomWhatsApp($notifiable)
    {
        // Access the OTP directly
        $otp = $this->otp;

        // Send WhatsApp message using Twilio
        $client = new \Twilio\Rest\Client(env('TWILIO_SID'), env('TWILIO_AUTH_TOKEN'));
        $client->messages->create(
            'whatsapp:' . $notifiable->phone_number, // WhatsApp recipient's phone number
            [
                'from' => env('TWILIO_WHATSAPP_NUMBER'),
                'body' => "Your OTP code is: {$otp}",  // Send OTP code
            ]
        );
    }
}


