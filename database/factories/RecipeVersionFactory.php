<?php
namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\IngredientSpecification;
use App\Models\Recipe;
use App\Models\RecipeVersion;
use App\Models\Unit; // Import Unit model
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RecipeVersionFactory extends Factory
{
    public function definition(): array
    {
        return [
            "recipe_id" => Recipe::factory(),
            "organisation_id" => fn(array $attributes) => Recipe::find(
                $attributes["recipe_id"],
            )->organisation_id,
            "version" => "1.0",
            "name" => fn(array $attributes) => Recipe::find(
                $attributes["recipe_id"],
            )->name,
            "description" => fake()->optional(0.8)->paragraph(),
            "status" => "draft",
            "count" => fake()->optional(0.6)->numberBetween(10, 200),
            "yield" => fake()->optional(0.8)->randomFloat(2, 0.5, 20),
            "unit_id" => Unit::inRandomOrder()->first()->id, // Select an existing Unit randomly
            "changelog" => fake()->optional(0.4)->sentence(),
            "created_by" => fn(array $attributes) => Recipe::find(
                $attributes["recipe_id"],
            )->created_by,
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

    public function withIngredients(array $ingredients): static
    {
        return $this->afterCreating(function (
            RecipeVersion $recipeVersion,
        ) use ($ingredients) {
            foreach ($ingredients as $ingredient) {
                // Get a random IngredientSpecification for the ingredient
                $ingredientSpecification = IngredientSpecification::where(
                    "ingredient_id",
                    $ingredient->id,
                )
                    ->where("organisation_id", $recipeVersion->organisation_id)
                    ->inRandomOrder()
                    ->first();

                if ($ingredientSpecification) {
                    $recipeVersion->ingredients()->attach($ingredient->id, [
                        "ingredient_specification_id" =>
                            $ingredientSpecification->id,
                        "quantity" => fake()->randomFloat(2, 10, 500),
                        "unit_id" => Unit::inRandomOrder()->first()->id, // Assuming Unit is seeded
                        "waste_percentage" => fake()
                            ->optional(0.4)
                            ->randomFloat(2, 1, 15),
                        "notes" => fake()->optional(0.3)->sentence(),
                    ]);
                }
            }
        });
    }
}
