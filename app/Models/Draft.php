<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Draft extends Model
{
    protected $guarded = ['id'];

    public function platinum(): BelongsTo
    {
        return $this->belongsTo(Platinum::class);
    }
}
