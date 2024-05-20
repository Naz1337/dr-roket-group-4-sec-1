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
            $table->string('author' );
            $table->string('title');
            $table->date('publisheddate');
            $table->string('type');
            $table->foreignId('expert_domain_id');
            $table->foreignId('platinum_id');
            $table->string('description');
            $table->string('p_path');
            $table->string('p_filename');
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
