<?php

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
        Schema::create('publications', function (Blueprint $table) {
            $table->id();
            $table->string('authors' );
            $table->string('title');
            $table->date('published_date');
            $table->string('type');
            $table->string('volume');
            $table->string('issues');
            $table->string('pages');
            $table->string('publisher');
            $table->string('description');
            $table->string('p_path');
            $table->foreignId('expert_domain_id')->nullable();
            $table->foreignId('platinum_id');
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publication');
    }
};
