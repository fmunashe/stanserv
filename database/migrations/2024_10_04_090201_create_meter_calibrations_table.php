<?php

use App\Models\MeterDetail;
use App\Models\MeterOwner;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('meter_calibrations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(MeterOwner::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(MeterDetail::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->date('calibration_date');
            $table->date('next_date_of_calibration');
            $table->string('calibrated_by');
            $table->string('assisted_by')->nullable();
            $table->text('calibration_product_used');
            $table->text('calibration_method');
            $table->string('sealing_pliers_number')->nullable();
            $table->text('avg_meter_percentage_error_before_adjustments')->nullable();
            $table->text('avg_meter_percentage_error_for_the_last_four_readings')->nullable();
            $table->text('avg_meter_factor_for_the_last_four_readings')->nullable();
            $table->longText('signature')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_calibrations');
    }
};
