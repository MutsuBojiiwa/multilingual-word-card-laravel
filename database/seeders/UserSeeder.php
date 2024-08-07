<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        DB::table('users')->upsert(
            [
                [
                    'name' => 'ゲストユーザー',
                    'email' => 'user@example.com',
                    'password' => Hash::make('password'),
                ],
                [
                    'name' => 'user2',
                    'email' => 'user2@example.com',
                    'password' => Hash::make('password'),
                ],
            ],
            ['email']
        );
    }
}
