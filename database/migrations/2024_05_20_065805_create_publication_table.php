<?php

use App\Models\ExpertDomain;
use App\Models\Platinum;
// use App\Models\ExpertDomain;
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
            $table->string('P_authors' );
            $table->string('P_title');
            $table->date('P_published_date');
            $table->string('P_type');
            $table->integer('P_volume')->nullable();
            $table->integer('P_issues')->nullable();
            $table->integer('P_pages');
            $table->string('P_publisher');
            $table->string('P_description');
            $table->string('P_path');
            $table->foreignIdFor(Platinum::class)->nullable()->constrained();
            $table->foreignIdFor(ExpertDomain::class)->nullable()->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('publications');
    }
};
