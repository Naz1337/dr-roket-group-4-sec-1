<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FocusItem extends Model
{
    public function weekly_focus()
    {
        return $this->belongsTo(WeeklyFocus::class);
    }
}
