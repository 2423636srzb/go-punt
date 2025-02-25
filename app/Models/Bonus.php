<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bonus extends Model
{
    protected $table = 'bonuses';

    // Define fillable properties to allow mass assignment
    protected $fillable = [
        'user_id',
        'plateform_id',
        'bonus',
        'granted_by',
        'redem',
        'dedicated_to',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
