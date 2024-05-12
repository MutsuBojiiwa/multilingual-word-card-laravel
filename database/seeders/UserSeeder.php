<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'user2',
            'email' => 'user2@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'user3',
            'email' => 'user3@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'user4',
            'email' => 'user4@example.com',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'user5',
            'email' => 'user5@example.com',
            'password' => Hash::make('password'),
        ]);
    }
}
