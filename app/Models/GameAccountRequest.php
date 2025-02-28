<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameAccountRequest extends Model
{
    protected $table ='game_account_request';
    protected $fillable = [
        'user_id',
        'game_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
{
    return $this->belongsTo(Game::class);
}
}
