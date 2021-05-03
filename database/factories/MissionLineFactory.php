<?php

namespace Database\Factories;

use App\Models\MissionLine;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissionLineFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MissionLine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'quantity' => $this->faker->numberBetween(1, 15),
            'title' => $this->faker->word(),
            'price' => $this->faker->numberBetween(1, 1000),
            'unity' => $this->faker->randomElement(['units', 'kg', 'cm']),
            // 'mission_id' => $this->faker->numberBetween(1, 20),
        ];
    }
}
