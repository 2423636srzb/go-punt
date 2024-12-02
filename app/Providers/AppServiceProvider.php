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
            // Get the authenticated user
            $user = auth()->user();
        
            // Check if user is authenticated
            if ($user) {
                // Get accounts associated with the current user
                $accounts = \App\Models\Account::whereHas('user', function ($query) use ($user) {
                    // Ensure we filter accounts associated with the current user
                    $query->where('user_id', $user->id);
                })->with('game') // Load the game relationships
                  ->get();
        
                // Pass the filtered accounts and the authenticated user to the view
                $view->with('shareaccounts', $accounts);
                $view->with('user', $user);
            } else {
                // If no user is authenticated, pass empty data or handle accordingly
                $view->with('shareaccounts', collect()); // Empty collection if no user
                $view->with('user', null);
            }
        });
        
        
    }
}
