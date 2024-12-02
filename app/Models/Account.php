<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\UserAccount;
use App\Models\Game;

class Account extends Model
{
    use HasFactory;

    // Specify the table name if it doesn't follow Laravel's naming convention
    protected $table = 'accounts';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'game_id',
        'username',
        'password',
        'is_assigned',
    ];

    /**
     * Relationship: Account belongs to a game.
     */
    public function game()
    {
        return $this->belongsTo(Game::class);
    }

    /**
     * Relationship: Account may be assigned to a user via the UserAccount model.
     */
    public function userAccount()
    {
        return $this->hasOne(UserAccount::class);
    }
    public function user()
    {
        return $this->belongsToMany(User::class, 'user_accounts', 'account_id', 'user_id');
    }
}
