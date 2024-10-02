<?php

use App\Models\PumpCalibration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pump_calibration_measure_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PumpCalibration::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->decimal('pump_under_test_volume');
            $table->decimal('corrected_volume');
            $table->decimal('difference')->nullable()->default(0);
            $table->text('corrective_action')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pump_calibration_measure_details');
    }
};
