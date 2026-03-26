<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\ProductionRun;
use App\Models\RecipeVersion;
use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ProductionRun>
 */
class ProductionRunFactory extends Factory
{
    public function definition(): array
    {
        return [
            "organisation_id" => Organisation::factory(),
            "recipe_version_id" => RecipeVersion::factory()->committed(),
            "print_count" => fake()->numberBetween(20, 500),
            "produced_at" => fake()->dateTimeBetween("-3 months", "now"),
            "produced_count" => fake()->numberBetween(10, 500),
            "produced_yield" => fake()->randomFloat(2, 0.5, 50),
            "unit_id" => Unit::factory(),
        ];
    }
}
