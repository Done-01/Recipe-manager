<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\IngredientSpecification;
use App\Models\NutritionProfile;
use App\Models\Organisation;
use App\Models\Supplier;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<IngredientSpecification>
 */
class IngredientSpecificationFactory extends Factory
{
    public function definition(): array
    {
        return [
            "ingredient_id" => Ingredient::factory(),
            "organisation_id" => Organisation::factory(),
            "supplier_id" => Supplier::factory(),
            "nutrition_profile" => NutritionProfile::factory()->committed(),
            "cost_per_item" => fake()->numberBetween(50, 5000), // stored in pence
            "item_size" => fake()->randomFloat(2, 0.1, 25),
            "unit_id" => null,
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
     * The specification has been reviewed and committed.
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
     * The specification has been superseded by a newer version.
     */
    public function superseded(): static
    {
        return $this->committed()->state(
            fn(array $attributes) => [
                "superseded_by" => IngredientSpecification::factory()->committed(),
                "superseded_at" => fake()->dateTimeBetween(
                    "-3 months",
                    "-1 week",
                ),
            ],
        );
    }

    /**
     * The specification has been retired.
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
