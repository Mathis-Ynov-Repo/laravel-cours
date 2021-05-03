<?php

namespace Database\Factories;

use App\Models\Organisation;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganisationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = organisation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $randomNumber = $this->faker->numberBetween(1, 3);
        $randomWord = "";
        if ($randomNumber === 3) {
            $randomWord = "school";
        } else if ($randomNumber === 2) {
            $randomWord = "client";
        } else {
            $randomWord = "government";
        }
        return [
            'id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'slug' => $this->faker->unique()->slug(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->phoneNumber(),
            'address' => $this->faker->address(),
            'type' => $this->faker->randomElement(['school', 'government', 'client']),
        ];
    }
}
