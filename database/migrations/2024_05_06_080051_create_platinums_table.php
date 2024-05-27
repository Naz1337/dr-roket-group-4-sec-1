<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('platinums', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class)->nullable()->constrained();
            $table->string('plat_name');
            $table->string('plat_ic');
            $table->string('plat_title',10);
            $table->integer('plat_gender');
            $table->string('plat_religion',50);
            $table->string('plat_race');
            $table->string('plat_citizenship');
            $table->binary('plat_photo');
//            $table->integer('plat_type');
            $table->string('plat_address');
            $table->string('plat_address2');
            $table->string('plat_city',50);
            $table->string('plat_state',100);
            $table->string('plat_postcode',10);
            $table->string('plat_country');
            $table->string('plat_phone_no',20);
            $table->string('plat_email',100);
            $table->string('plat_fbname');
            $table->string('plat_cur_edu_level',20);
            $table->string('plat_edu_field',100);
            $table->string('plat_edu_institute',100);
            $table->string('plat_occupation',100);
            $table->string('plat_study_sponsor',100);
            $table->string('plat_discover_type');
            $table->integer('plat_prog_interest');
            $table->string('plat_batch');
            $table->integer('plat_has_referral');
            $table->string('plat_referral_name')->nullable();
            $table->string('plat_referral_batch')->nullable();
            $table->string('plat_tshirt');
            $table->boolean('plat_app_confirm');
            $table->dateTime('plat_app_confirm_date');
            $table->integer('plat_payment_type');
            $table->string('plat_payment_proof');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('platinums');
    }
};
