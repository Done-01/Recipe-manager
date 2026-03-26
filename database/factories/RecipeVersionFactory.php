<?php

namespace Database\Factories;

use App\Models\Recipe;
use App\Models\RecipeVersion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RecipeVersion>
 */
class RecipeVersionFactory extends Factory
{
    public function definition(): array
    {
        return [
            "recipe_id" => Recipe::factory(),
            "version" => "1.0",
            "name" => fake()->words(3, true),
            "description" => fake()->optional(0.8)->paragraph(),
            "status" => "draft",
            "count" => fake()->optional(0.6)->numberBetween(10, 200),
            "yield" => fake()->optional(0.8)->randomFloat(2, 0.5, 20),
            "unit_id" => null,
            "changelog" => fake()->optional(0.4)->sentence(),
            "created_by" => User::factory(),
            "created_at" => fake()->dateTimeBetween("-1 year", "-1 month"),
            "commited_by" => null,
            "commited_at" => null,
            "superseded_by" => null,
            "superseded_at" => null,
            "retired_by" => null,
        ];
    }

    /**
     * A committed (live) version — status is set to 'current'.
     */
    public function committed(): static
    {
        return $this->state(
            fn(array $attributes) => [
                "status" => "current",
                "commited_by" => User::factory(),
                "commited_at" => fake()->dateTimeBetween(
                    "-6 months",
                    "-1 week",
                ),
            ],
        );
    }

    /**
     * An uncommitted draft version.
     */
    public function draft(): static
    {
        return $this->state(
            fn(array $attributes) => [
                "status" => "draft",
                "commited_by" => null,
                "commited_at" => null,
            ],
        );
    }

    /**
     * A version that has been superseded by a newer committed version.
     */
    public function superseded(): static
    {
        return $this->committed()->state(
            fn(array $attributes) => [
                "superseded_by" => RecipeVersion::factory()->committed(),
                "superseded_at" => fake()->dateTimeBetween(
                    "-3 months",
                    "-1 week",
                ),
            ],
        );
    }
}
