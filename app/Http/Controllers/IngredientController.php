<?php

namespace App\Http\Controllers;

use App\Models\Ingredient;
use Illuminate\Http\Request;

class IngredientController extends Controller
{
    public function index()
    {
        $ingredients = Ingredient::with("organisation", "createdBy")
            ->orderBy("name")
            ->get();

        return view("ingredients.index", compact("ingredients"));
    }

    public function create()
    {
        return view("ingredients.create");
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => ["required", "string", "max:255"],
        ]);

        // change this when authorised properly
        $validated["organisation_id"] = 1;
        $validated["created_by"] = 1;

        Ingredient::create($validated);

        return redirect()
            ->route("ingredients.index")
            ->with("success", "Ingredient created successfully.");
    }

    public function show(Ingredient $ingredient)
    {
        return view("ingredients.show", compact("ingredient"));
    }

    public function edit(Ingredient $ingredient)
    {
        return view("ingredients.edit", compact("ingredient"));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            "name" => ["required", "string", "max:255"],
        ]);

        $validated["updated_by"] = 1;

        $ingredient->update($validated);

        return redirect()
            ->route("ingredients.index")
            ->with("success", "Ingredient updated successfully.");
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->update([
            "deleted_by" => 1,
        ]);

        $ingredient->delete();

        return redirect()
            ->route("ingredients.index")
            ->with("success", "Ingredient deleted successfully.");
    }
}
