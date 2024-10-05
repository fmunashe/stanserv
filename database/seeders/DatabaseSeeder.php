<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(PermissionSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(PermissionRoleSeeder::class);
        $this->call(RoleUserSeeder::class);
        $this->call(CompartmentSeeder::class);
        $this->call(VolumeSeeder::class);
        $this->call(MeterTypeSeeder::class);

    }
}
