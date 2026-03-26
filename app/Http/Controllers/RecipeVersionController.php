<?php

namespace App\Http\Controllers;

use App\Models\RecipeVersion;
use Illuminate\Http\Request;
use App\Models\Recipe;

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

    public function create()
    {
        // }
    }

    public function store(Request $request)
    {
        // }
    }

    public function show(RecipeVersion $recipeVersion)
    {
        // }
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
