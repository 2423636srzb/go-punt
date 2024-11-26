<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserGame extends Model
{
    use HasFactory;

    protected $table = 'user_games';

    protected $fillable = [
        'user_id',
        'game_id',
    ];

    /**
     * Each game belongs to a specific user.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Optionally, define a relationship to a Game model if one exists.
     */
    public function game()
    {
        return $this->belongsTo(Game::class, 'game_id', 'id');
    }
}
