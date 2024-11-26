<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Account;

class UserAccount extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'user_accounts';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'user_id',
        'account_id',
        'assigned_at',
    ];

    /**
     * Relationship: UserAccount belongs to a User.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relationship: UserAccount belongs to an Account.
     */
    public function account()
    {
        return $this->belongsTo(Account::class);
    }
}
