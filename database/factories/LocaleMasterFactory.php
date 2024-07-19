<?php

namespace Database\Factories;

use App\Models\LocaleMaster;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocaleMasterFactory extends Factory
{
    protected $model = LocaleMaster::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
            'code' => $this->faker->languageCode,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
