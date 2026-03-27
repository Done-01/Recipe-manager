<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientSpecification;
use App\Models\RecipeVersion;
use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\RecipeIngredient;
use App\Models\Unit;

class RecipeVersionController extends Controller
{
    public function index(Recipe $recipe)
    {
        $recipeVersions = $recipe
            ->versions()
            ->with("unit", "commitedBy")
            ->orderBy("version")
            ->get();

        return view(
            "recipe-versions.index",
            compact("recipe", "recipeVersions"),
        );
    }

    public function create(Recipe $recipe)
    {
        $units = Unit::all();
        return view("recipe-versions.create", compact("recipe", "units"));
    }

    public function store(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            "version" => "required|integer",
            "name" => "required|string",
            "changelog" => "required|string",
        ]);

        $recipe->versions()->create([
            "version" => $validated["version"],
            "name" => $validated["name"],
            "changelog" => $validated["changelog"],
            "created_by" => auth()->id(),
            "created_at" => now(),
        ]);

        return redirect()
            ->route("recipes.recipe-versions.index", $recipe->id)
            ->with("success", "Recipe version created successfully.");
    }

    public function show(Recipe $recipe, RecipeVersion $recipeVersion)
    {
        abort_if($recipeVersion->recipe_id !== $recipe->id, 404);

        $organisationId = auth()->user()->currentOrganisation()->id;

        $ingredients = Ingredient::where("organisation_id", $organisationId)
            ->orderBy("name")
            ->get();
        $units = Unit::orderBy("unit_name")->get();
        $ingredientSpecifications = IngredientSpecification::with([
            "ingredient",
            "supplier",
            "unit",
        ])
            ->where("organisation_id", $organisationId)
            ->orderBy("id")
            ->get();

        $recipeIngredients = RecipeIngredient::with([
            "ingredient",
            "ingredientSpecification.ingredient",
            "ingredientSpecification.supplier",
            "unit",
        ])
            ->where("recipe_version_id", $recipeVersion->id)
            ->get();

        return view("recipe-versions.show", compact(
            "recipe",
            "recipeVersion",
            "ingredients",
            "units",
            "ingredientSpecifications",
            "recipeIngredients",
        ));
    }

    public function edit(RecipeVersion $recipeVersion)
    {
        // }
    }

    public function update(Request $request, RecipeVersion $recipeVersion)
    {
        // }
    }

    public function destroy(RecipeVersion $recipeVersion)
    {
        // }
    }

    public function storeIngredients(
        Request $request,
        Recipe $recipe,
        RecipeVersion $recipeVersion,
    ) {
        abort_if($recipeVersion->recipe_id !== $recipe->id, 404);

        $validated = $request->validate([
            "ingredients" => ["required", "array", "min:1"],
            "ingredients.*.ingredient_id" => ["required", "exists:ingredients,id"],
            "ingredients.*.ingredient_specification_id" => [
                "nullable",
                "exists:ingredient_specifications,id",
            ],
            "ingredients.*.quantity" => ["required", "numeric", "gt:0"],
            "ingredients.*.unit_id" => ["required", "exists:units,id"],
            "ingredients.*.waste_percentage" => ["nullable", "numeric", "min:0"],
            "ingredients.*.notes" => ["nullable", "string"],
        ]);

        foreach ($validated["ingredients"] as $ingredientData) {
            $recipeVersion->ingredients()->attach($ingredientData["ingredient_id"], [
                "ingredient_specification_id" =>
                    $ingredientData["ingredient_specification_id"] ?: null,
                "quantity" => $ingredientData["quantity"],
                "unit_id" => $ingredientData["unit_id"],
                "waste_percentage" =>
                    $ingredientData["waste_percentage"] ?: null,
                "notes" => $ingredientData["notes"] ?: null,
            ]);
        }

        return redirect()
            ->route("recipes.recipe-versions.show", [
                "recipe" => $recipe,
                "recipe_version" => $recipeVersion,
            ])
            ->with("success", "Ingredients added to recipe version.");
    }
}
