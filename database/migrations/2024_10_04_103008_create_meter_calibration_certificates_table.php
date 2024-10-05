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
        Schema::create('meter_calibration_certificates', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(MeterCalibration::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('certificate_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_calibration_certificates');
    }
};
