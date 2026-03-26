<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Supplier>
 */
class SupplierFactory extends Factory
{
    public function definition(): array
    {
        return [
            "name" => fake()->company(),
            "organisation_id" => Organisation::factory(),
            "address" => fake()->optional(0.9)->address(),
            "email" => fake()->optional(0.9)->companyEmail(),
            "telephone_number" => fake()->phoneNumber(),
            "notes" => fake()->optional(0.6)->paragraph(),
            "created_by" => User::factory(),
            "created_at" => fake()->dateTimeBetween("-2 years", "-6 months"),
            "superseded_by" => null,
            "superseded_at" => null,
            "retired_by" => null,
        ];
    }

    /**
     * Mark the supplier as retired, superseded by a newer supplier record.
     */
    public function retired(): static
    {
        return $this->state(
            fn(array $attributes) => [
                "superseded_at" => fake()->dateTimeBetween(
                    "-3 months",
                    "-1 week",
                ),
                "retired_by" => User::factory(),
            ],
        );
    }
}
