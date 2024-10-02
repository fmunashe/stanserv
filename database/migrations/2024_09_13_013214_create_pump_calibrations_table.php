<?php

use App\Models\PumpDetail;
use App\Models\PumpOwner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pump_calibrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamps();
            $table->foreignIdFor(PumpOwner::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(PumpDetail::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('calibration_date');
            $table->date('next_date_of_calibration');
            $table->string('calibrated_by');
            $table->string('assisted_by')->nullable();
            $table->text('calibration_product_used');
            $table->text('calibration_method');
            $table->text('standard');
            $table->text('serial_number');
            $table->string('material_of_construction')->default('Stainless Steel');
            $table->string('trade_measures_inspector')->nullable();
            $table->string('sealing_pliers_number')->nullable();
            $table->decimal('avg_pump_percentage_error_before_adjustments')->nullable()->default(0.0);
            $table->decimal('avg_pump_percentage_error_before_assize')->nullable();
            $table->longText('signature')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pump_calibrations');
    }
};
