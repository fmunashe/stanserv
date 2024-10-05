<?php

use App\Models\MeterOwner;
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
        Schema::create('meter_details', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(MeterOwner::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(MeterType::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('location')->nullable();
            $table->string('model')->nullable();
            $table->string('serial_number')->nullable();
            $table->string('flow_rate')->nullable();
            $table->string('meter_resolution')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('meter_details');
    }
};
