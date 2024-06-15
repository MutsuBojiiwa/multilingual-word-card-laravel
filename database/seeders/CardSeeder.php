<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Card;

class CardSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $deckIds = [1, 1, 1, 1, 1, 1, 1, 1, 2, 2, 2, 2];

        foreach ($deckIds as $deckId) {
            Card::create([
                'deck_id' => $deckId
            ]);
        }
    }
}
