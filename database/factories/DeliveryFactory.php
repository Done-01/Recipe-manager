<?php

namespace Database\Factories;

use App\Models\Delivery;
use App\Models\IngredientSpecification;
use App\Models\Organisation;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Delivery>
 */
class DeliveryFactory extends Factory
{
    public function definition(): array
    {
        return [
            "organisation_id" => Organisation::factory(),
            "ingredient_specification_id" => IngredientSpecification::factory(),
            "supplier_id" => Supplier::factory(),
            "delivery_date" => fake()->dateTimeBetween("-6 months", "now"),
            "quantity" => fake()->numberBetween(1, 50),
            "loc_code" => strtoupper(fake()->bothify("?#-##")),
            "created_by" => User::factory(),
            "created_at" => fake()->dateTimeBetween("-6 months", "now"),
            "commited_by" => null,
            "commited_at" => null,
            "superseded_by" => null,
            "superseded_at" => null,
            "retired_by" => null,
        ];
    }

    /**
     * Mark the delivery as committed (locked for editing).
     */
    public function committed(): static
    {
        return $this->state(
            fn(array $attributes) => [
                "commited_by" => User::factory(),
                "commited_at" => fake()->dateTimeBetween(
                    "-3 months",
                    "-1 week",
                ),
            ],
        );
    }

    /**
     * Mark the delivery as superseded by a newer delivery record.
     */
    public function superseded(): static
    {
        return $this->committed()->state(
            fn(array $attributes) => [
                "superseded_by" => Delivery::factory()->committed(),
                "superseded_at" => fake()->dateTimeBetween(
                    "-2 months",
                    "-1 week",
                ),
            ],
        );
    }
}
