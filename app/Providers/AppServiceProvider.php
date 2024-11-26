<?php

namespace App\Providers;

use App\Models\Announcement;
use App\Models\WebsiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $settings = WebsiteSetting::first(); // Assuming only one row for global settings
        view()->share('websiteSettings', $settings);

        $announcement = Announcement::first();
        View()->share('announcement',$announcement);
       
        View::composer('*', function ($view) {
            $view->with('accounts', \App\Models\Account::all());
            $view->with('user', auth()->user() ? auth()->user() : null);  // Ensure user is never null
        });
        
    }
}
