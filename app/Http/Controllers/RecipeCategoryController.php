<?php

namespace App\Http\Controllers;

use App\Models\RecipeCategory;
use Illuminate\Http\Request;

class RecipeCategoryController extends Controller
{
    public function index()
    {
        $recipeCategories = RecipeCategory::with("organisation", "createdBy")
            ->orderBy("name")
            ->get();

        return view("recipe_categories.index", compact("recipeCategories"));
    }

    public function create()
    {
        return view('recipe_categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
        ]);
        $validated['organisation_id'] = 1;
        $validated['created_by'] = 1;
        $validated['updated_by'] = 1;

        # $validated['organisation_id'] = auth()->user()->organisations->first()->id;
        # $validated['created_by'] = auth()->id();
        # $validated['updated_by'] = auth()->id();

        RecipeCategory::create($validated);

        return redirect()->route('recipe-categories.index');
    }

    public function show(RecipeCategory $recipeCategory)
    {
        // }
    }

    public function edit(RecipeCategory $recipeCategory)
    {
        return view('recipe_categories.edit', compact('recipeCategory'));
    }

    public function update(Request $request, RecipeCategory $recipeCategory)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['updated_by'] = 1;

        $recipeCategory->update($validated);

        return redirect()
            ->route('recipe-categories.index')
            ->with('success', 'Recipe category updated successfully.');
    }

    public function destroy(RecipeCategory $recipeCategory)
    {
        $recipeCategory->update([
            'deleted_by' => 1,
        ]);

        $recipeCategory->delete();

        return redirect()
            ->route('recipe-categories.index')
            ->with('success', 'Recipe category deleted successfully.');
    }
}
