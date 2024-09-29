<?php

namespace Database\Seeders;

use App\Models\Goal;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class GoalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Goal::create(["start_period" => "2022-07-01", "end_period" => "2027-06-30", "years" => 5, "leader" => 5, "assistance" => 10, "baptisms" => 10, "programmed_visits" => 10, "conversions" => 10]);
    }
}
