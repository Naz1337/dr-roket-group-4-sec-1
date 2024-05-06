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
        Schema::create('focuses', function (Blueprint $table) {
            $table->id();
            $table->integer('focus_owner');
            $table->date('focus_start_date');
            $table->date('focus_end_date');
            // $table->string('FocusType', 8);
            $table->enum('focus_type', ['focus', 'admin', 'social', 'recover']);
            $table->text('focus_title');
            $table->text('focus_content');
            $table->text('focus_feedback')->nullable();

            $table->timestamps();


        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('focuses');
    }
};
