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
        Schema::create('calibration_standards', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PumpCalibration::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->text('standard')->nullable();
            $table->text('serial_number')->nullable();
            $table->string('material_of_construction')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('calibration_standards');
    }
};
