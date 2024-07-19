<?php

namespace Database\Factories;

use App\Models\CardDetail;
use App\Models\Card;
use App\Models\LocaleMaster;
use Illuminate\Database\Eloquent\Factories\Factory;

class CardDetailFactory extends Factory
{
    protected $model = CardDetail::class;

    public function definition()
    {
        return [
            'card_id' => Card::factory(),
            'locale_id' => LocaleMaster::factory(),
            'word' => $this->faker->word,
        ];
    }
}
