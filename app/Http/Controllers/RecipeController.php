<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $recipes = auth()->user()->currentOrganisation()->recipes;
        return view("recipes.index", compact("recipes"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("recipes.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255|min:3",
        ]);

        auth()
            ->user()
            ->currentOrganisation()
            ->recipes()
            ->create([
                "organisation_id" => auth()->user()->currentOrganisation()->id,
                "name" => $validated["name"],
                "created_by" => auth()->user()->id,
                "created_at" => now(),
            ]);

        return redirect()->route("recipes.index");
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        return view("recipes.show", compact("recipe"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        return view("recipes.edit", compact("recipe"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required|string",
            "instructions" => "required|string",
        ]);

        $recipe->update($validated);

        return redirect()->route("recipes.index");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route("recipes.index");
    }
}
