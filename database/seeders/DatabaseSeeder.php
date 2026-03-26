<?php

namespace Database\Seeders;

use App\Models\Allergen;
use App\Models\Ingredient;
use App\Models\IngredientSpecification;
use App\Models\Nutrient;
use App\Models\Organisation;
use App\Models\RecipeCategory;
use App\Models\RecipeVersion;
use App\Models\Supplier;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->seedReferenceData();

        $admin = User::factory()->create([
            "name" => "Admin User",
            "email" => "admin@example.com",
        ]);

        $users = User::factory(4)->create();

        Organisation::factory(2)
            ->withUsers(
                collect([$admin])
                    ->merge($users)
                    ->all(),
                $admin->id, // Pass the admin user's ID as created_by
            )
            ->create(["created_by" => $admin->id])
            ->each(fn(Organisation $org) => $this->seedOrganisation($org));
    }

    private function seedReferenceData(): void
    {
        $this->seedUnits();
        $this->seedAllergens();
        $this->seedNutrients();
    }

    private function seedOrganisation(Organisation $org): void
    {
        $this->createUsers($org);
        $suppliers = $this->createSuppliers($org);
        $recipeCategories = $this->createRecipeCategories($org);
        $ingredients = $this->createIngredients($org, $suppliers);
        $this->createRecipes($org, $recipeCategories, $ingredients);
    }

    private function createUsers(Organisation $org): void
    {
        User::factory(5)
            ->withOrganisations([$org])
            ->create();
    }

    private function createSuppliers(Organisation $org): Collection
    {
        return Supplier::factory(3)->create([
            "organisation_id" => $org->id,
        ]);
    }

    private function createRecipeCategories(Organisation $org): Collection
    {
        return RecipeCategory::factory(4)->create([
            "organisation_id" => $org->id,
        ]);
    }

    private function createIngredients(
        Organisation $org,
        Collection $suppliers,
    ): Collection {
        return Ingredient::factory(10)
            ->has(
                IngredientSpecification::factory(rand(1, 2))
                    ->state(
                        fn(array $attributes, Ingredient $ingredient) => [
                            "supplier_id" => $suppliers->random()->id,
                            "organisation_id" => $ingredient->organisation_id,
                            "created_by" => $ingredient->created_by,
                        ],
                    )
                    ->afterCreating(function (IngredientSpecification $spec) {
                        $allergens = Allergen::all()->random(rand(0, 3));
                        $spec
                            ->allergens()
                            ->attach($allergens->pluck("id")->toArray(), [
                                "is_trace" => fake()->boolean(25),
                            ]);
                    }),
                "specifications",
            )
            ->create([
                "organisation_id" => $org->id,
            ]);
    }

    private function createRecipes(
        Organisation $org,
        Collection $recipeCategories,
        Collection $ingredients,
    ): void {
        RecipeVersion::factory(6)
            ->withIngredients($ingredients->random(rand(3, 6))->all())
            ->create([
                "organisation_id" => $org->id,
                "recipe_id" => fn() => \App\Models\Recipe::factory()->create([
                    "organisation_id" => $org->id,
                    "recipe_category_id" => $recipeCategories->random()->id, // Corrected from recipe_category_id
                ]),
            ]);
    }

    private function seedUnits(): void
    {
        $rows = [
            [
                "unit_name" => "Gram",
                "unit_abbreviation" => "g",
                "type" => "weight",
            ],
            [
                "unit_name" => "Kilogram",
                "unit_abbreviation" => "kg",
                "type" => "weight",
            ],
            [
                "unit_name" => "Ounce",
                "unit_abbreviation" => "oz",
                "type" => "weight",
            ],
            [
                "unit_name" => "Pound",
                "unit_abbreviation" => "lb",
                "type" => "weight",
            ],
            [
                "unit_name" => "Millilitre",
                "unit_abbreviation" => "ml",
                "type" => "volume",
            ],
            [
                "unit_name" => "Litre",
                "unit_abbreviation" => "l",
                "type" => "volume",
            ],
            [
                "unit_name" => "Teaspoon",
                "unit_abbreviation" => "tsp",
                "type" => "volume",
            ],
            [
                "unit_name" => "Tablespoon",
                "unit_abbreviation" => "tbsp",
                "type" => "volume",
            ],
            [
                "unit_name" => "Each",
                "unit_abbreviation" => "ea",
                "type" => "count",
            ],
            [
                "unit_name" => "Kilocalorie",
                "unit_abbreviation" => "kcal",
                "type" => "count",
            ],
            [
                "unit_name" => "Kilojoule",
                "unit_abbreviation" => "kJ",
                "type" => "count",
            ],
        ];

        foreach ($rows as $row) {
            Unit::firstOrCreate(
                ["unit_abbreviation" => $row["unit_abbreviation"]],
                $row,
            );
        }
    }

    private function seedAllergens(): void
    {
        collect([
            ["allergen_name" => "Cereals containing gluten", "EU_ref" => 1],
            ["allergen_name" => "Crustaceans", "EU_ref" => 2],
            ["allergen_name" => "Eggs", "EU_ref" => 3],
            ["allergen_name" => "Fish", "EU_ref" => 4],
            ["allergen_name" => "Peanuts", "EU_ref" => 5],
            ["allergen_name" => "Soybeans", "EU_ref" => 6],
            ["allergen_name" => "Milk", "EU_ref" => 7],
            ["allergen_name" => "Nuts", "EU_ref" => 8],
            ["allergen_name" => "Celery", "EU_ref" => 9],
            ["allergen_name" => "Mustard", "EU_ref" => 10],
            ["allergen_name" => "Sesame seeds", "EU_ref" => 11],
            [
                "allergen_name" => "Sulphur dioxide and sulphites",
                "EU_ref" => 12,
            ],
            ["allergen_name" => "Lupin", "EU_ref" => 13],
            ["allergen_name" => "Molluscs", "EU_ref" => 14],
        ])->each(
            fn($row) => Allergen::firstOrCreate(
                ["EU_ref" => $row["EU_ref"]],
                $row,
            ),
        );
    }

    private function seedNutrients(): void
    {
        collect([
            [
                "nutrient_name" => "Energy",
                "unit" => "kcal",
                "display_order" => 1,
            ],
            [
                "nutrient_name" => "Energy (kJ)",
                "unit" => "kJ",
                "display_order" => 2,
            ],
            ["nutrient_name" => "Fat", "unit" => "g", "display_order" => 3],
            [
                "nutrient_name" => "Saturated Fat",
                "unit" => "g",
                "display_order" => 4,
            ],
            [
                "nutrient_name" => "Carbohydrate",
                "unit" => "g",
                "display_order" => 5,
            ],
            ["nutrient_name" => "Sugars", "unit" => "g", "display_order" => 6],
            ["nutrient_name" => "Fibre", "unit" => "g", "display_order" => 7],
            ["nutrient_name" => "Protein", "unit" => "g", "display_order" => 8],
            ["nutrient_name" => "Salt", "unit" => "g", "display_order" => 9],
        ])->each(
            fn($row) => Nutrient::firstOrCreate(
                ["nutrient_name" => $row["nutrient_name"]],
                [
                    "unit_id" => Unit::where(
                        "unit_abbreviation",
                        $row["unit"],
                    )->first()->id,
                    "display_order" => $row["display_order"],
                ],
            ),
        );
    }
}
