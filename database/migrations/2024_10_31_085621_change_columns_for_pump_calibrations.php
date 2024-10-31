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
        Schema::table('pump_calibrations', function (Blueprint $table) {
            $table->string('avg_pump_percentage_error_before_adjustments')->nullable()->default(0.0)->change();
            $table->string('avg_pump_percentage_error_before_assize')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pump_calibrations', function (Blueprint $table) {
            $table->string('avg_pump_percentage_error_before_adjustments')->nullable()->default(0.0);
            $table->string('avg_pump_percentage_error_before_assize')->nullable();
        });
    }
};
