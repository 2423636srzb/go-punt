<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OTP extends Model
{
    use HasFactory;

    // Define the table name if it's not plural (optional)
    protected $table = 'otps';

    // Define the fillable attributes to allow mass assignment
    protected $fillable = [
        'user_id',
        'otp',
        'expires_at',
    ];

    // Define the relationship with the User model (assuming you have a User model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
