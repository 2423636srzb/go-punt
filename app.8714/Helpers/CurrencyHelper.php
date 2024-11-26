<?php

function setCurrency($amount, $currency = null)
{
    $currency = $currency ?? config('app.currency');
    $symbol = match ($currency) {
        'USD' => '$',
        'EUR' => '€',
        'PKR' => '₨',
        'INR' => '₹',  // Indian Rupee symbol
        default => '',
    };

    return $symbol . number_format($amount, 0);
}
