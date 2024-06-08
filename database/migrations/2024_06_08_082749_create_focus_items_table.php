<?php

use App\Enums\BlockType;
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
        Schema::create('focus_items', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(\App\Models\WeeklyFocus::class);
            $table->enum('block_type', [BlockType::FOCUS, BlockType::ADMIN, BlockType::SOCIAL, BlockType::RECOVERY]);
            $table->text('task');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('focus_items');
    }
};
