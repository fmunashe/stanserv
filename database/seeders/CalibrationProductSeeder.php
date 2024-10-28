<?php

namespace Database\Seeders;

use App\Models\CalibrationProduct;
use Illuminate\Database\Seeder;

class CalibrationProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ["name" => "BLENDED PETROL"],
            ["name" => "UNLEADED PETROL"],
            ["name" => "DIESEL"],
            ["name" => "PARAFFIN"],
            ["name" => "ETHANOL"],
            ["name" => "LACQUER THINNERS"],
            ["name" => "ETHYL ACETATE"],
            ["name" => "N. P. A"],
            ["name" => "B/OXITOL"]
        ];
        foreach ($products as $product) {
            CalibrationProduct::query()->firstOrCreate($product, $product);
        }
    }
}
