<?php

namespace Database\Seeders;

use App\Models\Allergen;
use App\Models\Delivery;
use App\Models\Ingredient;
use App\Models\IngredientSpecification;
use App\Models\Nutrient;
use App\Models\NutritionProfile;
use App\Models\Organisation;
use App\Models\ProductionRun;
use App\Models\Recipe;
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
        $units = $this->seedUnits();
        $allergens = $this->seedAllergens();
        $nutrients = $this->seedNutrients($units);

        $admin = User::factory()->create([
            "name" => "Admin User",
            "email" => "admin@example.com",
        ]);

        $users = User::factory(4)->create();

        Organisation::factory(2)
            ->create(["created_by" => $admin->id])
            ->each(
                fn(Organisation $org) => $this->seedOrganisation(
                    $org,
                    $admin,
                    $users,
                    $allergens,
                    $nutrients,
                    $units,
                ),
            );
    }

    // -------------------------------------------------------------------------
    // Reference data — seeded once, shared across all organisations
    // -------------------------------------------------------------------------

    /** @return array<string, Unit> Keyed by unit abbreviation e.g. 'g', 'kg', 'ml' */
    private function seedUnits(): array
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

        $units = [];
        foreach ($rows as $row) {
            $units[$row["unit_abbreviation"]] = Unit::firstOrCreate(
                ["unit_abbreviation" => $row["unit_abbreviation"]],
                $row,
            );
        }
        return $units;
    }

    /** @return Collection<int, Allergen> All 14 EU-listed allergens */
    private function seedAllergens(): Collection
    {
        return collect([
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
        ])->map(
            fn($row) => Allergen::firstOrCreate(
                ["EU_ref" => $row["EU_ref"]],
                $row,
            ),
        );
    }

    /**
     * Standard UK food-label nutrients, ordered by display_order.
     *
     * @param  array<string, Unit> $units
     * @return Collection<int, Nutrient>
     */
    private function seedNutrients(array $units): Collection
    {
        return collect([
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
        ])->map(
            fn($row) => Nutrient::firstOrCreate(
                ["nutrient_name" => $row["nutrient_name"]],
                [
                    "unit_id" => $units[$row["unit"]]->id,
                    "display_order" => $row["display_order"],
                ],
            ),
        );
    }

    // -------------------------------------------------------------------------
    // Organisation tree
    // -------------------------------------------------------------------------

    private function seedOrganisation(
        Organisation $org,
        User $admin,
        Collection $users,
        Collection $allergens,
        Collection $nutrients,
        array $units,
    ): void {
        $this->attachUsers($org, $admin, $users);

        $suppliers = Supplier::factory(3)->create([
            "organisation_id" => $org->id,
            "created_by" => $admin->id,
        ]);

        $categories = RecipeCategory::factory(4)->create([
            "organisation_id" => $org->id,
            "created_by" => $admin->id,
        ]);

        // Build the ingredient pool, which also creates all deliveries
        $allSpecs = $this->seedIngredients(
            $org,
            $admin,
            $suppliers,
            $allergens,
            $nutrients,
            $units,
        );

        // Fetch all deliveries for this org once — passed down to production runs
        $orgDeliveries = Delivery::where("organisation_id", $org->id)->get();

        $this->seedRecipes(
            $org,
            $admin,
            $categories,
            $allSpecs,
            $orgDeliveries,
            $units,
        );
    }

    /**
     * Attach all users to the organisation via the organisation_users pivot.
     * withTimestamps() on the relationship handles created_at / updated_at automatically.
     */
    private function attachUsers(
        Organisation $org,
        User $admin,
        Collection $users,
    ): void {
        $org->users()->attach($admin->id, [
            "role" => "admin",
            "created_by" => $admin->id,
        ]);

        foreach ($users as $user) {
            $org->users()->attach($user->id, [
                "role" => "user",
                "created_by" => $admin->id,
            ]);
        }
    }

    // -------------------------------------------------------------------------
    // Ingredients, nutrition profiles, specs, allergens, deliveries
    // -------------------------------------------------------------------------

    /**
     * Creates 10 ingredients per org. Each gets:
     *   - 1 committed nutrition profile with all 9 nutrients attached
     *   - 1–2 committed ingredient specifications
     *   - 0–3 allergens per spec (some as trace)
     *   - 2–4 committed deliveries per spec
     *
     * @return Collection<int, IngredientSpecification>
     */
    private function seedIngredients(
        Organisation $org,
        User $admin,
        Collection $suppliers,
        Collection $allergens,
        Collection $nutrients,
        array $units,
    ): Collection {
        $allSpecs = collect();

        Ingredient::factory(10)
            ->create([
                "organisation_id" => $org->id,
                "created_by" => $admin->id,
            ])
            ->each(function (Ingredient $ingredient) use (
                $org,
                $admin,
                $suppliers,
                $allergens,
                $nutrients,
                $units,
                $allSpecs,
            ) {
                $profile = NutritionProfile::factory()->create([
                    "organisation_id" => $org->id,
                    "name" => $ingredient->name . " — Nutrition Profile",
                    "source" => "supplier_spec",
                    "created_by" => $admin->id,
                    "commited_by" => $admin->id,
                    "commited_at" => now()->subMonths(rand(1, 6)),
                ]);

                // Attach all 9 nutrients with realistic per-100g quantities
                $nutrients->each(
                    fn(Nutrient $nutrient) => $profile
                        ->nutrients()
                        ->attach($nutrient->id, [
                            "quantity" => fake()->randomFloat(2, 0.01, 50),
                        ]),
                );

                // 1–2 specifications per ingredient (e.g. two different pack sizes)
                IngredientSpecification::factory(rand(1, 2))
                    ->create([
                        "ingredient_id" => $ingredient->id,
                        "organisation_id" => $org->id,
                        "supplier_id" => $suppliers->random()->id,
                        "nutrition_profile" => $profile->id,
                        "unit_id" => $units["kg"]->id,
                        "created_by" => $admin->id,
                        "commited_by" => $admin->id,
                        "commited_at" => now()->subMonths(rand(1, 6)),
                    ])
                    ->each(function (IngredientSpecification $spec) use (
                        $allergens,
                        $org,
                        $admin,
                        $allSpecs,
                    ) {
                        $allSpecs->push($spec);

                        // 0–3 allergens per spec, with ~25% chance any one is trace-only
                        $allergenCount = min(rand(0, 3), $allergens->count());
                        if ($allergenCount > 0) {
                            $allergens->random($allergenCount)->each(
                                fn(Allergen $allergen) => $spec
                                    ->allergens()
                                    ->attach($allergen->id, [
                                        "is_trace" => fake()->boolean(25),
                                    ]),
                            );
                        }

                        // 2–4 committed deliveries for this spec
                        Delivery::factory(rand(2, 4))
                            ->committed()
                            ->create([
                                "organisation_id" => $org->id,
                                "ingredient_specification_id" => $spec->id,
                                "supplier_id" => $spec->supplier_id,
                                "created_by" => $admin->id,
                            ]);
                    });
            });

        return $allSpecs;
    }

    // -------------------------------------------------------------------------
    // Recipes, versions, production runs
    // -------------------------------------------------------------------------

    private function seedRecipes(
        Organisation $org,
        User $admin,
        Collection $categories,
        Collection $allSpecs,
        Collection $orgDeliveries,
        array $units,
    ): void {
        for ($i = 0; $i < 6; $i++) {
            $recipe = Recipe::factory()->create([
                "organisation_id" => $org->id,
                "category" => $categories->random()->id,
                "created_by" => $admin->id,
            ]);

            // Committed live version
            $currentVersion = RecipeVersion::factory()
                ->forRecipe($recipe)
                ->create([
                    "version" => "1.0",
                    "status" => "current",
                    "unit_id" => $units["g"]->id,
                    "commited_by" => $admin->id,
                    "commited_at" => now()->subMonths(
                        fake()->numberBetween(1, 6),
                    ),
                ]);

            // 50% chance a revised draft is in progress
            if (fake()->boolean(50)) {
                RecipeVersion::factory()
                    ->forRecipe($recipe)
                    ->draft()
                    ->create([
                        "version" => "2.0",
                        "unit_id" => $units["g"]->id,
                        "changelog" => "Updated formulation — in progress.",
                    ]);
            }
            if ($allSpecs->isNotEmpty()) {
                $this->attachIngredientsToVersion(
                    $currentVersion,
                    $allSpecs,
                    $units,
                );
            }

            $this->seedProductionRuns($currentVersion, $orgDeliveries, $units);
        }
    }

    /**
     * Attach 3–6 ingredient specifications to a recipe version.
     * Guards against adding the same ingredient twice to the same version.
     */
    private function attachIngredientsToVersion(
        RecipeVersion $version,
        Collection $allSpecs,
        array $units,
    ): void {
        $attached = collect();
        $sampleSize = min(rand(3, 6), $allSpecs->count());

        $allSpecs
            ->shuffle()
            ->take($sampleSize)
            ->each(function (IngredientSpecification $spec) use (
                $version,
                $units,
                $attached,
            ) {
                if ($attached->contains($spec->ingredient_id)) {
                    return;
                }

                $version->ingredients()->attach($spec->ingredient_id, [
                    "ingredient_specification_id" => $spec->id,
                    "quantity" => fake()->randomFloat(2, 10, 500),
                    "unit_id" => $units["g"]->id,
                    "waste_percentage" => fake()
                        ->optional(0.4)
                        ->randomFloat(2, 1, 15),
                    "notes" => fake()->optional(0.3)->sentence(),
                ]);

                $attached->push($spec->ingredient_id);
            });
    }

    /**
     * Create 2–3 production runs for a recipe version, each linked to
     * 2–4 deliveries via the production_run_ingredients pivot.
     * Pivot data is keyed by delivery ID to prevent duplicate rows.
     */
    private function seedProductionRuns(
        RecipeVersion $version,
        Collection $orgDeliveries,
        array $units,
    ): void {
        ProductionRun::factory(fake()->numberBetween(2, 3))
            ->create([
                "organisation_id" => $version->organisation_id,
                "recipe_version_id" => $version->id,
                "unit_id" => $units["kg"]->id,
            ])
            ->each(function (ProductionRun $run) use ($orgDeliveries, $units) {
                if ($orgDeliveries->isEmpty()) {
                    return;
                }
                $count = min(
                    fake()->numberBetween(2, 4),
                    $orgDeliveries->count(),
                );
                $run->deliveries()->attach(
                    $orgDeliveries
                        ->shuffle()
                        ->take($count)
                        ->mapWithKeys(
                            fn(Delivery $delivery) => [
                                $delivery->id => [
                                    "ingredient_specification_id" =>
                                        $delivery->ingredient_specification_id,
                                    "yield" => fake()->randomFloat(2, 0.5, 10),
                                    "unit_id" => $units["kg"]->id,
                                ],
                            ],
                        )
                        ->all(),
                );
            });
    }
}
