<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platinum extends Model
{
    protected $fillable = [
        'user_id',
        'plat_name',
        'plat_ic',
        'plat_title',
        'plat_gender',
        'plat_religion',
        'plat_race',
        'plat_citizenship',
        'plat_photo',
        'plat_address',
        'plat_address2',
        'plat_city',
        'plat_state',
        'plat_postcode',
        'plat_country',
        'plat_phone_no',
        'plat_email',
        'plat_fbname',
        'plat_cur_edu_level',
        'plat_edu_field',
        'plat_edu_institute',
        'plat_occupation',
        'plat_study_sponsor',
        'plat_discover_type',
        'plat_prog_interest',
        'plat_batch',
        'plat_has_referral',
        'plat_referral_name',
        'plat_referral_batch',
        'plat_tshirt',
        'plat_app_confirm',
        'plat_app_confirm_date',
        'plat_payment_type',
        'plat_payment_proof',
    ];

    public function myexperts(): HasMany
    {
        return $this->hasMany(ExpertDomain::class, 'platinum_id');
    }

    public function publications(): HasMany
    {
        return $this->hasMany(Publication::class, 'platinum_id');
    }

    public function drafts()
    {
        return $this->hasMany(Draft::class);
    }

    public function crmp()
    {
        return $this->belongsTo(User::class, 'assigned_crmp_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
