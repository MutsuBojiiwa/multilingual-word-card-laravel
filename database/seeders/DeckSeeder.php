<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Deck;

class DeckSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Deck::create([
            'user_id' => 1,
            'name' => 'テストデッキ_日英仏',
            'is_favorite' => false,
            'is_public' => false
        ]);
    }
}
