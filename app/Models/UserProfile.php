<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    use HasFactory;

    protected $fillable = [
        'profile_name',
        'birth_date',
        'profile_email',
        'user_photo',
        'phone_no',
        'address',
        'address2',
    ];
}
