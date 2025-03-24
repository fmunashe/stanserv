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
        Schema::table('pump_calibration_measure_details', function (Blueprint $table) {
            $table->string('corrected_volume')->change();
            $table->string('difference')->nullable()->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pump_calibration_measure_details', function (Blueprint $table) {
            $table->decimal('corrected_volume', 10, 4);
            $table->decimal('difference', 10, 4)->nullable()->default(0);
        });
    }
};
