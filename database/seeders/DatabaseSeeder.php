<?php

namespace Database\Seeders;

use App\Models\Contribution;
use App\Models\Mission;
use App\Models\MissionLine;
use App\Models\Organisation;
use App\Models\Transaction;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        Organisation::factory(10)
            ->has(Mission::factory(2)->has(MissionLine::factory(2)))
            ->has(Contribution::factory(2))
            ->create();

        $missions = Mission::all();
        $contributions = Contribution::all();

        foreach ($missions as $misison) {
            $total = 0;
            foreach ($misison->missionLines as $missionLine)
                $total += $missionLine->price * $missionLine->quantity;

            DB::table('transactions')->insert(
                [
                    'id' => $faker->uuid(),
                    'source_type' => '\App\Models\Mission',
                    'source_id' => $misison->id,
                    'price' => $total,
                    'created_at' => date('Y-m-d H:i:s'),

                    'paid_at' => $faker->date()
                ]
            );
        }
        foreach ($contributions as $contribution) {
            DB::table('transactions')->insert(
                [
                    'id' => $faker->uuid(),
                    'source_type' => '\App\Models\Contribution',
                    'source_id' => $contribution->id,
                    'price' => $contribution->price,
                    'created_at' => date('Y-m-d H:i:s'),
                    'paid_at' => $faker->date()
                ]
            );
        }
    }
}
