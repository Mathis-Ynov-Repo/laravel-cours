<?php

namespace Database\Factories;

use App\Models\Mission;
use Illuminate\Database\Eloquent\Factories\Factory;

class MissionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Mission::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'reference' => $this->faker->word(),
            'title' => $this->faker->word(),
            'comment' => $this->faker->word(),
            'deposit' => $this->faker->numberBetween(1, 1000),
            // 'organisation_id' => \App\Models\Organisation::inRandomOrder()->first(),
            'ended_at' => $this->faker->date(),
        ];
    }
}
