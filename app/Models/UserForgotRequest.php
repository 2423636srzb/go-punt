<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class UserForgotRequest extends Model
{
    protected $table = 'user_forgot_request'; // Update to match your table name
    protected $fillable = ['user_account_id','status','game_name','account_name','password','requested_by','is_read'];

    public function userAccount()
    {
        return $this->belongsTo(UserAccount::class, 'user_account_id', 'id');
    }
}
