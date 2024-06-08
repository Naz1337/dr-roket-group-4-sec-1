<?php

use App\Enums\FeedbackTypes;
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
        Schema::create('feedback_messages', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\Platinum::class);
            $table->enum('type', [FeedbackTypes::DRAFT, FeedbackTypes::FOCUS]);
            $table->text('message');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('feedback_messages');
    }
};
