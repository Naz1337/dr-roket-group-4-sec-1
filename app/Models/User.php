<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use \Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'email',
        'password',
        'user_type'
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

    public function userProfile(): HasOne
    {
        return $this->hasOne(UserProfile::class);
    }

    public function platinum(): HasOne
    {
        return $this->hasOne(PLatinum::class);
    }

    public function getPlatinum(): ?Platinum
    {
        return $this->user_type == Config::get('constants.user.platinum') ? $this->platinum : null;
    }

    public function getUserProfile(): ?UserProfile
    {
        return $this->user_type == Config::get('constants.user.staff') ? $this->userProfile : null;
    }

    public function assigned_platinums()
    {
        return $this->hasMany(Platinum::class, 'assigned_crmp_id');
    }
}
