<?php

use App\Models\MeterCalibration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meter_calibration_measure_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(MeterCalibration::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('run_number');
            $table->string('master_meter_flow_rate');
            $table->string('master_meter_volume');
            $table->string('master_meter_temperature');
            $table->string('master_meter_pressure');
            $table->string('line_meter_volume');
            $table->string('difference')->nullable();
            $table->string('meter_factor')->nullable();
            $table->string('percentage_error')->nullable();
            $table->longText('remarks')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_calibration_measure_details');
    }
};
