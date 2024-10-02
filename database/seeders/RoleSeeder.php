<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'name' => 'Admin', 'description' => 'Administrator Role'],
            ['id' => 2, 'name' => 'User', 'description' => 'User Role']
        ];
        foreach ($roles as $role) {
            Role::query()->firstOrCreate($role, $role);
        }
    }
}
