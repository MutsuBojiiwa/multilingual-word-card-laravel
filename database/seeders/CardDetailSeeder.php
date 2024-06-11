<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\CardDetail;

class CardDetailSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['card_id' => 1, 'locale_id' => 1, 'word' => 'こんにちは'],
            ['card_id' => 1, 'locale_id' => 2, 'word' => 'hello'],
            ['card_id' => 1, 'locale_id' => 3, 'word' => 'bonjour'],
            ['card_id' => 2, 'locale_id' => 1, 'word' => 'さようなら'],
            ['card_id' => 2, 'locale_id' => 2, 'word' => 'goodbye'],
            ['card_id' => 2, 'locale_id' => 3, 'word' => 'au revoir'],
            ['card_id' => 3, 'locale_id' => 1, 'word' => 'おはよう'],
            ['card_id' => 3, 'locale_id' => 2, 'word' => 'good morning'],
            ['card_id' => 3, 'locale_id' => 3, 'word' => 'bon matin'],
            ['card_id' => 4, 'locale_id' => 1, 'word' => 'こんばんは'],
            ['card_id' => 4, 'locale_id' => 2, 'word' => 'good evening'],
            ['card_id' => 4, 'locale_id' => 3, 'word' => 'bonsoir'],
            ['card_id' => 5, 'locale_id' => 1, 'word' => 'ありがとう'],
            ['card_id' => 5, 'locale_id' => 2, 'word' => 'thank you'],
            ['card_id' => 5, 'locale_id' => 3, 'word' => 'merci'],
            ['card_id' => 6, 'locale_id' => 1, 'word' => 'ごめんなさい'],
            ['card_id' => 6, 'locale_id' => 2, 'word' => 'sorry'],
            ['card_id' => 6, 'locale_id' => 3, 'word' => 'désolé'],
            ['card_id' => 7, 'locale_id' => 1, 'word' => 'はい'],
            ['card_id' => 7, 'locale_id' => 2, 'word' => 'yes'],
            ['card_id' => 7, 'locale_id' => 3, 'word' => 'oui'],
            ['card_id' => 8, 'locale_id' => 1, 'word' => 'いいえ'],
            ['card_id' => 8, 'locale_id' => 2, 'word' => 'no'],
            ['card_id' => 8, 'locale_id' => 3, 'word' => 'non'],
        ];

        foreach ($data as $item) {
            CardDetail::create($item);
        }
    }
}
