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
            $table->string('percentage_error')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pump_calibration_measure_details', function (Blueprint $table) {
            $table->dropColumn('percentage_error');
        });
    }
};
