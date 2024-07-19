<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\LocaleMaster;
use Illuminate\Database\Seeder;

use Database\Seeders\UserSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (app()->environment('testing')) {
            //テストのときはシーダーを使わない
        } else {
            $this->call([
                // ここにSeederを追記するといっぺんに実行できる
                UserSeeder::class,
                LocaleMasterSeeder::class,
                DeckSeeder::class,
                CardSeeder::class,
                CardDetailSeeder::class,
            ]);
        }
    }
}
