<?php

namespace Database\Factories;

use App\Models\Organisation;
use App\Models\RecipeCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<RecipeCategory>
 */
class RecipeCategoryFactory extends Factory
{
    private static array $categories = [
        "Breads & Rolls",
        "Cakes & Gateaux",
        "Pastries & Viennoiserie",
        "Biscuits & Cookies",
        "Tarts & Pies",
        "Sauces & Condiments",
        "Fillings & Creams",
        "Snacks & Bars",
        "Celebration Cakes",
        "Savoury Bakes",
        "Vegan Range",
        "Gluten-Free Range",
        "Desserts",
        "Breakfasts",
        "Confectionery",
        "Drinks & Smoothies",
        "Sandwiches & Wraps",
        "Soups & Broths",
    ];

    public function definition(): array
    {
        return [
            "name" => fake()->randomElement(self::$categories),
            "organisation_id" => Organisation::factory(),
            "created_by" => User::factory(),
        ];
    }
}
