<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Account;

class Game extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'logo',
        'login_link',
        'status',
    ];

    public function getLogoUrlAttribute()
    {
        return asset('storage/logos/' . $this->logo);
    }
    public function accounts()
    {
        return $this->hasMany(Account::class);
    }

    public function platform()
{
    return $this->belongsTo(Game::class);
}
public function accountRequest(){
    return $this->hasMany(GameAccountRequest::class);
}

public function requests()
{
    return $this->hasMany(GameAccountRequest::class, 'game_id', 'id');
}
}
