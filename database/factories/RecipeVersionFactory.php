<?php
namespace Database\Factories;

use App\Models\Recipe;
use App\Models\RecipeVersion;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeVersionFactory extends Factory
{
    public function definition(): array
    {
        $recipe = Recipe::factory()->create();

        return [
            "recipe_id" => $recipe->id,
            "organisation_id" => $recipe->organisation_id,
            "version" => "1.0",
            "name" => $recipe->name,
            "description" => fake()->optional(0.8)->paragraph(),
            "status" => "draft",
            "count" => fake()->optional(0.6)->numberBetween(10, 200),
            "yield" => fake()->optional(0.8)->randomFloat(2, 0.5, 20),
            "unit_id" => null,
            "changelog" => fake()->optional(0.4)->sentence(),
            "created_by" => $recipe->created_by,
            "created_at" => fake()->dateTimeBetween("-1 year", "-1 month"),
            "commited_by" => null,
            "commited_at" => null,
            "superseded_by" => null,
            "superseded_at" => null,
            "retired_by" => null,
        ];
    }
    public function forRecipe(Recipe $recipe): static
    {
        return $this->state([
            "recipe_id" => $recipe->id,
            "organisation_id" => $recipe->organisation_id,
            "name" => $recipe->name,
            "created_by" => $recipe->created_by,
        ]);
    }
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

    public function superseded(): static
    {
        return $this->committed()->state(
            fn(array $attributes) => [
                "superseded_by" => RecipeVersion::factory()
                    ->committed()
                    ->for(Recipe::find($attributes["recipe_id"])),
                "superseded_at" => fake()->dateTimeBetween(
                    "-3 months",
                    "-1 week",
                ),
            ],
        );
    }
}
