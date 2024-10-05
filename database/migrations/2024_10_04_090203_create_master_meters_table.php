<?php

use App\Models\MeterCalibration;
use App\Models\MeterType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_meters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(MeterCalibration::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(MeterType::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('model');
            $table->string('serial_number');
            $table->string('flow_rate');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_meters');
    }
};
