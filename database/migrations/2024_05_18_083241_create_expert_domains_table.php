<?php

use App\Models\Platinum;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('expert_domains', function (Blueprint $table) {
            $table->id();
            $table->string('expert_domain_names');
            $table->string('expert_domain_emails');
            $table->string('expert_domain_phonenumbers');
            $table->string('expert_domain_affiliation');
            $table->string('expert_domain_research_title');
            $table->string('expert_domain_image');
            $table->timestamps();
            $table->foreignIdFor(Platinum::class)->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('expert_domains');
    }
};
