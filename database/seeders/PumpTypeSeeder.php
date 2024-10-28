<?php

namespace Database\Seeders;

use App\Models\PumpType;
use Illuminate\Database\Seeder;

class PumpTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pumpTypes = [
            ["pump_type" => "GILBARCO"],
            ["pump_type" => "WAYNE"],
            ["pump_type" => "TOKHEIM"],
            ["pump_type" => "PROWALCO"],
            ["pump_type" => "EHAD"],
            ["pump_type" => "PIUSI"]
        ];
        foreach ($pumpTypes as $type) {
            PumpType::query()->firstOrCreate($type, $type);
        }
    }
}
