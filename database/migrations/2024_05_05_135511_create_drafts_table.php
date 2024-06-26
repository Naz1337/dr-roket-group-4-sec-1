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
        Schema::create('drafts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(\App\Models\Platinum::class);
            $table->text('draft_title');
            $table->integer('draft_number');
            $table->date('draft_completion_date');
            $table->integer('draft_days_taken',false, true);
            $table->integer('draft_ddc');
            $table->text('draft_filename');
            $table->text('draft_filepath');
            $table->integer('draft_page_count', false, true);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drafts');
    }
};
