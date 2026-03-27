<?php

namespace App\Http\Controllers;

use App\Models\RecipeVersion;
use Illuminate\Http\Request;
use App\Models\Recipe;
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
        $recipeVersion->load([
            "recipeIngredients.ingredient",
            "recipeIngredients.unit",
        ]);
        return view("recipe-versions.show", compact("recipe", "recipeVersion"));
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
}
