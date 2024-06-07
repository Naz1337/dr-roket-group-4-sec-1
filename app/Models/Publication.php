<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Publication extends Model
{
    use HasFactory;

    protected $fillable = [
        'P_authors', 
        'P_title', 
        'P_published_date',
        'P_type',
        'P_volume',
        'P_issues',
        'P_pages',
        'P_publisher',
        'P_description',
        'P_path'
        ];    

     
    public function expertDomain()
    {
        return $this->belongsTo(ExpertDomain::class);
    }

    public function platinum()
    {
        return $this->belongsTo(Platinum::class);
    }
}
