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
        Schema::table('platinums', function (Blueprint $table) {
            $table->foreignId('assigned_crmp_id')->nullable()->constrained('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('platinums', function (Blueprint $table) {
            $table->dropForeign(['assigned_crmp_id']);
            $table->dropColumn('assigned_crmp_id');
        });
    }
};
