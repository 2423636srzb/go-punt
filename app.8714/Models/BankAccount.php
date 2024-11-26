<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    use HasFactory;

    // Define the table name if it's different from plural of model name
    protected $table = 'bank_accounts';

    // Define the fillable fields
    protected $fillable = [
        'user_id',
        'bank_name',
        'account_number',
        'account_holder_name',
        'iban_number',
    ];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
