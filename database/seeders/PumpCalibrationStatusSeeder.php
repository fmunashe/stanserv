<?php

namespace Database\Seeders;

use App\Models\PumpCalibrationStatus;
use Illuminate\Database\Seeder;

class PumpCalibrationStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $statuses = [
            ['id' => 1, 'status' => 'Pump passed the calibration and assize tests'],
            ['id' => 2, 'status' => 'Pump passed the calibration test'],
            ['id' => 3, 'status' => 'Pump failed the calibration and assize tests.'],
            ['id' => 4, 'status' => 'Pump failed the calibration test.']
        ];

        foreach ($statuses as $status) {
            PumpCalibrationStatus::query()->firstOrCreate($status, $status);
        }
    }
}
