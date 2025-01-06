<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Notifications\ChannelManager;
use App\Channels\CustomWhatsAppChannel;

class NotificationServiceProvider extends ServiceProvider
{
    public function register()
    {
        // Register any application services.
    }

    public function boot()
    {
        // Manually bind the custom channel
        $this->app->make(ChannelManager::class)->extend('customWhatsApp', function () {
            return new CustomWhatsAppChannel();
        });
    }
}
