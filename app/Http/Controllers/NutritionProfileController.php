<?php

namespace App\Http\Controllers;

use App\Models\NutritionProfile;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class NutritionProfileController extends Controller
{
    public function index()
    {
        $nutritionProfiles = NutritionProfile::with([
            'organisation',
            'createdBy',
            'commitedBy',
            'supersededBy',
            'retiredBy',
        ])->get();

        return view('nutrition_profiles.index', compact('nutritionProfiles'));
    }

    public function create()
    {
        return view('nutrition_profiles.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'source' => ['required', Rule::in([
                'manual',
                'supplier_spec',
                'mccance',
                'library',
                'partner',
            ])],
        ]);

        $validated['organisation_id'] = 1;
        $validated['created_by'] = 1;

        NutritionProfile::create($validated);

        return redirect()
            ->route('nutrition-profiles.index')
            ->with('success', 'Nutrition profile created successfully.');
    }

    public function show(NutritionProfile $nutritionProfile)
    {
        
    }

    public function edit(NutritionProfile $nutritionProfile)
    {
        return view('nutrition_profiles.edit', compact('nutritionProfile'));
    }

    public function update(Request $request, NutritionProfile $nutritionProfile)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'source' => ['required', Rule::in([
                'manual',
                'supplier_spec',
                'mccance',
                'library',
                'partner',
            ])],
        ]);

        $nutritionProfile->update($validated);

        return redirect()
            ->route('nutrition-profiles.index')
            ->with('success', 'Nutrition profile updated successfully.');
    }

    public function destroy(NutritionProfile $nutritionProfile)
    {
        $nutritionProfile->update([
            'retired_by' => 1,
        ]);

        $nutritionProfile->delete();

        return redirect()
            ->route('nutrition-profiles.index')
            ->with('success', 'Nutrition profile deleted successfully.');
    }
}