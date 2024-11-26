<?php
use Illuminate\Support\Facades\DB;

function setCurrency($amount, $currency = null)
{
    $currency = $currency ?? config('app.currency');
    $setting = DB::table('settings')->first();
    $symbol = match ($setting->currency) {
        'USD' => '$',
        'EUR' => '€',
        'PKR' => '₨',
        'INR' => '₹',  // Indian Rupee symbol
        default => '',
    };

    return $symbol . number_format($amount, 0);
}
