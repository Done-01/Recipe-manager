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
        return view('ingredients.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'redirect_to' => ['nullable', 'string'],
        ]);

        $redirectTo = $validated['redirect_to'] ?? null;
        unset($validated['redirect_to']);

        $validated['organisation_id'] = auth()->user()->currentOrganisation()->id;
        $validated['created_by'] = auth()->id();

        Ingredient::create($validated);

        if ($redirectTo) {
            return redirect($redirectTo)->with('success', 'Ingredient created successfully.');
        }

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient created successfully.');
    }

    public function show(Ingredient $ingredient)
    {

    }

    public function edit(Ingredient $ingredient)
    {
        return view('ingredients.edit', compact('ingredient'));
    }

    public function update(Request $request, Ingredient $ingredient)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $validated['updated_by'] = 1;

        $ingredient->update($validated);

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient updated successfully.');
    }

    public function destroy(Ingredient $ingredient)
    {
        $ingredient->update([
            'deleted_by' => 1,
        ]);

        $ingredient->delete();

        return redirect()
            ->route('ingredients.index')
            ->with('success', 'Ingredient deleted successfully.');
    }
}
