<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ExpertDomain extends Model
{
    use HasFactory;

    // Input Expert May Change

    protected $fillable = [
        'expert_domain_names',
        'expert_domain_emails',
        'expert_domain_phonenumbers',
        'expert_domain_research_title',
        'expert_domain_image'
    ];

    public function platinum(): BelongsTo
    {
        return $this->belongsTo(Platinum::class, 'platinum_id');
    }
}
