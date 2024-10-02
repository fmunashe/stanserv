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
        Schema::create('pump_calibration_totaliser_readings', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PumpCalibration::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('tot_start');
            $table->string('tot_finish');
            $table->string('prod_drawn');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pump_calibration_totaliser_readings');
    }
};
