<?php

namespace Database\Seeders;

use App\Models\Contribution;
use App\Models\Mission;
use App\Models\MissionLine;
use App\Models\Organisation;
use App\Models\Transaction;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Organisation::factory(10)->create();
        // Mission::factory(20)->create();

        // Mission::factory(2)->has(MissionLine::factory()->count(3))->create();
        Organisation::factory(10)->has(Mission::factory(2)->has(MissionLine::factory(2)))->has(Contribution::factory(2))->create();
        Transaction::factory(10)->create();
        // Mission::factory()->create();
    }
}
