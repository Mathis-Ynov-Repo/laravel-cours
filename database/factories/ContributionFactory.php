<?php

namespace Database\Factories;

use App\Models\Contribution;
use Illuminate\Database\Eloquent\Factories\Factory;

class ContributionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Contribution::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->uuid(),
            'comment' => $this->faker->sentence(),
            'title' => $this->faker->word(),
            'comment' => $this->faker->word(),
            'price' => $this->faker->numberBetween(1, 1000),
            // 'organisation_id' => \App\Models\Organisation::inRandomOrder()->first(),
        ];
    }
}
