<?php

namespace Database\Seeders;

use App\Models\Volume;
use Illuminate\Database\Seeder;

class VolumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 100; $i <= 10000; $i += 100) {
            $volume = ['volume' => $i];
            Volume::query()->firstOrCreate($volume, $volume);
        }
    }
}
