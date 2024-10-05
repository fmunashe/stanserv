<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meter_owners', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('company_name');
            $table->string('address');
            $table->string('phone');
            $table->string('email')->nullable();
            $table->string('contact_person');
            $table->string('contact_person_phone');
            $table->string('contact_person_email')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_owners');
    }
};
