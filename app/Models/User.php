<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\UserAccount;
use App\Models\BankAccount;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'phone_number',
        'profile_image',
        'description',
        'language',
        'password',
        'is_admin'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    /**
     * Relationship: A user has one user account.
     */
    public function userAccount()
    {
        return $this->hasMany(UserAccount::class);
    }
    public function bonuses()
    {
        return $this->hasMany(Bonus::class);
    }
    // Define the relationship with the bank accounts table
    public function bankAccounts()
    {
        return $this->hasMany(BankAccount::class);
    }
    public function adminBankAccounts()
    {
        return $this->hasMany(AdminBankAccount::class);
    }
}
