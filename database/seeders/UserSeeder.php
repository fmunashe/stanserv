<?php

namespace Database\Seeders;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'id' => 1,
                'name' => 'Admin',
                'email' => 'support@stanserv.com',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'email_verified_at' => Carbon::now(),
            ],
            [
                'id' => 2,
                'name' => 'User',
                'email' => 'user@stanserv.com',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'email_verified_at' => Carbon::now()
            ], [
                'id' => 3,
                'name' => 'Farai',
                'email' => 'zihovem@gmail.com',
                'password' => Hash::make('password'),
                'remember_token' => null,
                'email_verified_at' => Carbon::now()
            ]
        ];
        foreach ($users as $user) {
            User::query()->firstOrCreate($user, $user);
        }
    }
}
