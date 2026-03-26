<?php

namespace Database\Factories;

use App\Models\NutritionProfile;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<NutritionProfile>
 */
class NutritionProfileFactory extends Factory
{
    public function definition(): array
    {
        return [
            "organisation_id" => Organisation::factory(),
            "name" => fake()->words(3, true),
            "source" => fake()->randomElement([
                "manual",
                "supplier_spec",
                "mccance",
                "library",
                "partner",
            ]),
            "created_by" => User::factory(),
            "commited_by" => null,
            "commited_at" => null,
            "superseded_by" => null,
            "superseded_at" => null,
            "retired_by" => null,
        ];
    }

    /**
     * The profile has been reviewed and committed.
     */
    public function committed(): static
    {
        return $this->state(
            fn(array $attributes) => [
                "commited_by" => User::factory(),
                "commited_at" => fake()->dateTimeBetween(
                    "-6 months",
                    "-1 week",
                ),
            ],
        );
    }

    /**
     * The profile has been superseded by a newer version.
     */
    public function superseded(): static
    {
        return $this->committed()->state(
            fn(array $attributes) => [
                "superseded_by" => NutritionProfile::factory()->committed(),
                "superseded_at" => fake()->dateTimeBetween(
                    "-3 months",
                    "-1 week",
                ),
            ],
        );
    }

    /**
     * The profile has been retired.
     */
    public function retired(): static
    {
        return $this->committed()->state(
            fn(array $attributes) => [
                "retired_by" => User::factory(),
            ],
        );
    }
}
