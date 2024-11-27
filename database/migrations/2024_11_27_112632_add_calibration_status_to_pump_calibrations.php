<?php

use App\Models\PumpCalibrationStatus;
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
            $table->foreignIdFor(PumpCalibrationStatus::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pump_calibrations', function (Blueprint $table) {
            $table->dropForeignIdFor(PumpCalibrationStatus::class);
        });
    }
};
