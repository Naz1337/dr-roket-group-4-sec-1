<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platinum extends Model
{
    protected $guarded = [];

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

    public function feedbackMessages(): HasMany
    {
        return $this->hasMany(FeedbackMessage::class);
    }

}
