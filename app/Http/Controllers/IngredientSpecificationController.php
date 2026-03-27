<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use App\Models\IngredientSpecification;
use App\Models\NutritionProfile;
use App\Models\Supplier;
use App\Models\Unit;
use Illuminate\Http\Request;

class IngredientSpecificationController extends Controller
{
    public function index()
    {
        $ingredientSpecifications = IngredientSpecification::with([
            "ingredient",
            "supplier",
            "unit",
            "nutritionProfile",
        ])->get();

        return view(
            "ingredient_specifications.index",
            compact("ingredientSpecifications"),
        );
    }

    public function create()
    {
        $ingredients = Ingredient::orderBy("name")->get();
        $suppliers = Supplier::orderBy("name")->get();
        $nutritionProfiles = NutritionProfile::orderBy("name")->get();
        $units = Unit::orderBy("unit_name")->get();

        return view(
            "ingredient_specifications.create",
            compact("ingredients", "suppliers", "nutritionProfiles", "units"),
        );
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "ingredient_id" => ["required", "exists:ingredients,id"],
            "supplier_id" => ["required", "exists:suppliers,id"],
            "nutrition_profile" => ["nullable", "exists:nutrition_profiles,id"],
            "cost_per_item" => ["nullable", "numeric"],
            "item_size" => ["nullable", "numeric"],
            "unit_id" => ["nullable", "exists:units,id"],
        ]);

        // change this when authorised properly
        $validated["organisation_id"] = 1;
        $validated["created_by"] = 1;

        IngredientSpecification::create($validated);

        return redirect()
            ->route("ingredient-specifications.index")
            ->with("success", "Ingredient specification created successfully.");
    }

    public function show(IngredientSpecification $ingredientSpecification)
    {
        return view(
            "ingredient_specifications.show",
            compact("ingredientSpecification"),
        );
    }

    public function edit(IngredientSpecification $ingredientSpecification)
    {
        $ingredients = Ingredient::orderBy("name")->get();
        $suppliers = Supplier::orderBy("name")->get();
        $nutritionProfiles = NutritionProfile::orderBy("name")->get();
        $units = Unit::orderBy("unit_name")->get();

        return view(
            "ingredient_specifications.edit",
            compact(
                "ingredientSpecification",
                "ingredients",
                "suppliers",
                "nutritionProfiles",
                "units",
            ),
        );
    }

    public function update(
        Request $request,
        IngredientSpecification $ingredientSpecification,
    ) {
        $validated = $request->validate([
            "ingredient_id" => ["required", "exists:ingredients,id"],
            "supplier_id" => ["required", "exists:suppliers,id"],
            "nutrition_profile" => ["nullable", "exists:nutrition_profiles,id"],
            "cost_per_item" => ["nullable", "numeric"],
            "item_size" => ["nullable", "numeric"],
            "unit_id" => ["nullable", "exists:units,id"],
        ]);

        $ingredientSpecification->update($validated);

        return redirect()
            ->route("ingredient-specifications.index")
            ->with("success", "Ingredient specification updated successfully.");
    }

    public function destroy(IngredientSpecification $ingredientSpecification)
    {
        $ingredientSpecification->delete();

        return redirect()
            ->route("ingredient-specifications.index")
            ->with("success", "Ingredient specification deleted successfully.");
    }
}
