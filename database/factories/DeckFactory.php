<?php

namespace Database\Factories;

use App\Models\Deck;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeckFactory extends Factory
{
    protected $model = Deck::class;

    public function definition()
    {
        return [
            // 'user_id' => $this->user->id,
            'name' => $this->faker->word,
            'is_favorite' => $this->faker->boolean(),
            'is_public' => $this->faker->boolean(),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
