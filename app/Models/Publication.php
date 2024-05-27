<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = ['authors', 'title', 'published_date', 'type', 'volume','issues','pages','publisher','description', ];    

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function expertDomain()
    {
        return $this->belongsTo(ExpertDomain::class);
    }

    public function platinum()
    {
        return $this->belongsTo(Platinum::class);
    }
}
