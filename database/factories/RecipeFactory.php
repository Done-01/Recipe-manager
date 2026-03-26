<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\Recipe;
use App\Models\RecipeCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Recipe>
 */
class RecipeFactory extends Factory
{
    private static array $recipes = [
        "Victoria Sponge",
        "Chocolate Fudge Cake",
        "Lemon Drizzle Cake",
        "Carrot Cake",
        "Red Velvet Cake",
        "Banana Bread",
        "Coffee & Walnut Cake",
        "Sourdough Loaf",
        "White Sandwich Loaf",
        "Wholemeal Cob",
        "Seeded Baguette",
        "Focaccia",
        "Ciabatta",
        "Croissants",
        "Pain au Chocolat",
        "Cinnamon Swirls",
        "Chelsea Buns",
        "Danish Pastries",
        "Shortbread Biscuits",
        "Chocolate Chip Cookies",
        "Oat & Raisin Cookies",
        "Ginger Nuts",
        "Flapjack",
        "Chocolate Brownie",
        "Blondie",
        "Lemon Tart",
        "Apple Tart Tatin",
        "Bakewell Tart",
        "Quiche Lorraine",
        "Spinach & Feta Tart",
        "Sausage Roll",
        "Cheese Scones",
        "Classic Scones",
        "Hollandaise Sauce",
        "Béchamel Sauce",
        "Pesto Verde",
        "Hummus",
        "Tzatziki",
        "Granola Bar",
        "Rocky Road",
    ];

    public function definition(): array
    {
        return [
            "name" => fake()->randomElement(self::$recipes),
            "organisation_id" => Organisation::factory(),
            "recipe_category_id" => RecipeCategory::factory(), // Corrected from recipe_category_id
            "created_by" => User::factory(),
        ];
    }
}
