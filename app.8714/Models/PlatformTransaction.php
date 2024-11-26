<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use app\Models\User;
use app\Models\Account;

class PlatformTransaction extends Model
{
    protected $table = 'user_platform_transactions';
    protected $fillable = ['user_id', 'platform_id', 'amount', 'image', 'status', 'approved_at', 'rejected_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function platform()
    {
        return $this->belongsTo(Account::class, 'platform_id'); // Assuming Account is the table for platforms
    }
}

