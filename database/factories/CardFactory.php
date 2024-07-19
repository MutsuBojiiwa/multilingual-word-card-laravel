<?php

namespace Database\Factories;

use App\Models\Card;
use App\Models\Deck;
use App\Models\CardDetail;
use App\Models\LocaleMaster;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardFactory extends Factory
{
    protected $model = Card::class;

    public function definition()
    {
        return [
            'deck_id' => Deck::factory(), // ランダムなDeckを関連付ける
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function withDetails($count = 1)
    {
        return $this->afterCreating(function (Card $card) use ($count) {
            $locales = LocaleMaster::factory()->count($count)->create();
            foreach ($locales as $locale) {
                CardDetail::factory()->create(['card_id' => $card->id, 'locale_id' => $locale->id]);
            }
        });
    }
}
