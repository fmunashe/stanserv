<?php

namespace Database\Seeders;

use App\Models\PumpOwner;
use Illuminate\Database\Seeder;

class PumpOwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $owners = [
            ['company_name' => 'REDAN'],
            ['company_name' => 'OLD MUTUAL'],
            ['company_name' => 'CABS'],
            ['company_name' => 'MILLPAL'],
            ['company_name' => 'BANCABC'],
            ['company_name' => 'CCC'],
            ['company_name' => 'SURREY'],
            ['company_name' => 'ZIMBABWE LEAF TOBACCO'],
            ['company_name' => 'ROCKODOX'],
            ['company_name' => 'PUMA ENERGY'],
            ['company_name' => 'VIVO ENGEN'],
            ['company_name' => 'WHELSON TRANSPORT']
        ];
        foreach ($owners as $owner){
            PumpOwner::query()->firstOrCreate($owner,$owner);
        }
    }
}
