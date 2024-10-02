<?php

namespace Database\Seeders;

use App\Models\Compartment;
use Illuminate\Database\Seeder;

class CompartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 1; $i <= 6; $i++) {
            $compartment = ['compartment_number' => $i];
            Compartment::query()->firstOrCreate($compartment, $compartment);
        }
    }
}
