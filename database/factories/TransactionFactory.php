<?php

namespace Database\Factories;

use App\Models\Transaction;
use Illuminate\Database\Eloquent\Factories\Factory;

class TransactionFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Transaction::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $sourceType = $this->faker->randomElement(['\App\Models\Mission', '\App\Models\Contribution']);
        $sourceId = $sourceType == "\App\Models\Mission" ? \App\Models\Mission::inRandomOrder()->first()->id : \App\Models\Contribution::inRandomOrder()->first()->id;
        return [
            'id' => $this->faker->uuid(),
            'source_type' => $sourceType,
            'source_id' => $sourceId,
            'price' => $this->faker->numberBetween(1, 1000),
            // 'organisation_id' => \App\Models\Organisation::inRandomOrder()->first(),
        ];
    }
}
