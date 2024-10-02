<?php

use App\Models\PumpOwner;
use App\Models\PumpType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pump_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(PumpOwner::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->foreignIdFor(PumpType::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('location');
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
        Schema::dropIfExists('pump_details');
    }
};
