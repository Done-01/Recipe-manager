<?php

namespace Database\Factories;

use App\Models\Ingredient;
use App\Models\IngredientSpecification;
use App\Models\Organisation;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Ingredient>
 */
class IngredientFactory extends Factory
{
    private static array $ingredients = [
        "Plain Flour",
        "Self-Raising Flour",
        "Wholemeal Flour",
        "Strong White Bread Flour",
        "Rye Flour",
        "Spelt Flour",
        "Rice Flour",
        "Cornflour",
        "Buckwheat Flour",
        "Unsalted Butter",
        "Salted Butter",
        "Block Margarine",
        "Lard",
        "Vegetable Shortening",
        "Caster Sugar",
        "Icing Sugar",
        "Soft Brown Sugar",
        "Demerara Sugar",
        "Granulated Sugar",
        "Treacle",
        "Golden Syrup",
        "Maple Syrup",
        "Honey",
        "Agave Nectar",
        "Free Range Eggs",
        "Full Fat Milk",
        "Skimmed Milk",
        "Semi-Skimmed Milk",
        "Double Cream",
        "Single Cream",
        "Soured Cream",
        "Crème Fraîche",
        "Buttermilk",
        "Cream Cheese",
        "Mascarpone",
        "Greek Yoghurt",
        "Natural Yoghurt",
        "Ricotta",
        "Vegetable Oil",
        "Sunflower Oil",
        "Olive Oil",
        "Rapeseed Oil",
        "Coconut Oil",
        "Fine Salt",
        "Sea Salt Flakes",
        "Baking Powder",
        "Bicarbonate of Soda",
        "Dried Yeast",
        "Fresh Yeast",
        "Cream of Tartar",
        "Vanilla Extract",
        "Vanilla Bean Paste",
        "Almond Extract",
        "Lemon Extract",
        "Dark Chocolate (70%)",
        "Milk Chocolate",
        "White Chocolate",
        "Cocoa Powder",
        "Dark Cocoa Powder",
        "Chocolate Chips",
        "Rolled Oats",
        "Porridge Oats",
        "Jumbo Oats",
        "Oat Bran",
        "Ground Almonds",
        "Flaked Almonds",
        "Whole Almonds",
        "Walnut Pieces",
        "Pecan Halves",
        "Hazelnuts",
        "Pistachios",
        "Cashews",
        "Desiccated Coconut",
        "Sesame Seeds",
        "Poppy Seeds",
        "Sunflower Seeds",
        "Pumpkin Seeds",
        "Chia Seeds",
        "Raisins",
        "Sultanas",
        "Currants",
        "Dried Cranberries",
        "Dried Apricots",
        "Glacé Cherries",
        "Mixed Peel",
        "Dates",
        "Prunes",
        "Lemon Juice",
        "Orange Juice",
        "Lime Juice",
        "Lemon Zest",
        "Orange Zest",
        "White Wine Vinegar",
        "Apple Cider Vinegar",
        "Balsamic Vinegar",
        "Dijon Mustard",
        "Wholegrain Mustard",
        "English Mustard",
        "Garlic Powder",
        "Onion Powder",
        "Smoked Paprika",
        "Ground Cinnamon",
        "Ground Nutmeg",
        "Ground Ginger",
        "Mixed Spice",
        "Ground Cardamom",
        "Ground Cloves",
        "Ground Allspice",
        "Turmeric",
        "Ground Coriander",
        "Xanthan Gum",
        "Guar Gum",
        "Psyllium Husk",
        "Citric Acid",
        "Soy Lecithin",
        "Potassium Sorbate",
        "Ascorbic Acid",
    ];

    public function definition(): array
    {
        return [
            "name" => fake()->randomElement(self::$ingredients),
            "organisation_id" => Organisation::factory(),
            "created_by" => User::factory(),
        ];
    }

    public function withSpecifications(array|int $specifications): static
    {
        return $this->afterCreating(function (Ingredient $ingredient) use (
            $specifications,
        ) {
            $specifications = is_array($specifications)
                ? $specifications
                : IngredientSpecification::factory($specifications)->create([
                    "ingredient_id" => $ingredient->id,
                    "organisation_id" => $ingredient->organisation_id,
                ]);

            $ingredient->specifications()->saveMany($specifications);
        });
    }
}
