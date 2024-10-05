<?php

namespace Database\Seeders;

use App\Models\MeterType;
use Illuminate\Database\Seeder;

class MeterTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $meterTypes = [
            ['meter_type' => 'Smith', 'description' => 'Smith'],
            ['meter_type' => 'Averry Hardoll', 'description' => 'Averry Hardoll']
        ];

        foreach ($meterTypes as $meterType) {
            MeterType::query()->firstOrCreate($meterType, $meterType);
        }
    }
}
