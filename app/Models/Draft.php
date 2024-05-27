<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Draft extends Model
{
    protected $guarded = ['id'];

    protected $attributes = [
        'draft_owner' => 1  // Tunggu Juel-san
    ];

    /* TODO: tunggu juel buat keje and then uncomment ni V */
    /*public function owner(): BelongsTo
    {
        return $this->belongsTo(Platinum::class, 'draft_owner');
    }*/
}
