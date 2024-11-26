<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WebsiteSetting extends Model
{
    protected $table = 'settings'; // Update to match your table name
    protected $fillable = ['name', 'logo', 'currency', 'language'];
}

