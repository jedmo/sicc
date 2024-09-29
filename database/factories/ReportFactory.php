<?php

namespace Database\Factories;

use App\Models\Cell;
use App\Models\Report;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Report>
 */
class ReportFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'date' => fake()->randomElement(['2024-06-01','2024-06-08','2024-06-15', '2024-05-25']),
            'adult_sibling_attendance' => fake()->numberBetween(0, 4),
            'adult_friends_attendance' => fake()->numberBetween(0, 4),
            'total_adult_attendance' => fake()->numberBetween(2, 5),
            'youth_sibling_attendance' => fake()->numberBetween(0, 4),
            'youth_friends_attendance' => fake()->numberBetween(0, 4),
            'total_youth_attendance' => fake()->numberBetween(1, 4),
            'children_sibling_attendance' => fake()->numberBetween(0, 4),
            'children_friends_attendance' => fake()->numberBetween(0, 4),
            'total_children_attendance' => fake()->numberBetween(1, 4),
            'total_attendance' => fake()->numberBetween(4, 10),
            'conversions' => fake()->numberBetween(0, 4),
            'reconciliations' => fake()->numberBetween(0, 4),
            'programmed_visits' => fake()->numberBetween(0, 4),
            'water_baptisms' => fake()->numberBetween(0, 4),
            'church_offering' => fake()->randomFloat(2, 0, 3),
            'offering_meter_by_meter' => fake()->randomFloat(2, 0, 3),
            'pro_bus_offering' => fake()->randomFloat(2, 0, 3),
            'user_id' => 1,
            'cell_id' => function() {
                return Cell::count() > 0 ? Cell::all()->random()->id : null;
            }
        ];
    }
}
