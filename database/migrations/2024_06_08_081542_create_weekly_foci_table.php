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
        Schema::create('weekly_foci', function (Blueprint $table) {
            $table->id();

            $table->dateTime('start_date');
            $table->dateTime('end_date');

            $table->foreignIdFor(\App\Models\User::class);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('weekly_foci');
    }
};
