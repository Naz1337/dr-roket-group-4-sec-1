<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Platinum extends Model
{
    use HasFactory;





    public function myexperts(): HasMany
    {
        return $this->hasMany(ExpertDomain::class, 'platinum_id');
    }

}
