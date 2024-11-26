<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    //

    protected $fillable = [
        'amount',
        'user_id',
        'bank_account_id',
    ];
}
