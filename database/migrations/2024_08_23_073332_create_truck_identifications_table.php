<?php

use App\Models\TruckOwnerDetail;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('truck_identifications', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(TruckOwnerDetail::class)->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('make');
            $table->string('model');
            $table->date('year');
            $table->string('horse_chassis_number')->nullable();
            $table->string('engine_number')->nullable();
            $table->string('road_license_number')->nullable();
            $table->integer('mileage')->nullable();
            $table->enum('type_of_truck', ['Rigid', 'Articulated'])->nullable();
            $table->string('trailer_chassis_number')->nullable();
            $table->enum('tank_shape', ['Oval', 'Round'])->nullable();
            $table->string('fore_coupling_height')->nullable();
            $table->string('aft_coupling_height')->nullable();
            $table->string('air_bags_checked_satisfactory')->nullable();
            $table->enum('truck_suspension_type', ['Springs', 'Air Bags'])->nullable();
            $table->enum('air_bags_completely', ['Full', 'Empty'])->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('truck_identifications');
    }
};
