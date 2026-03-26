<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Allergen extends Model
{
    protected $fillable = ["allergen_name", "EU_ref"];

    public function ingredientSpecifications(): BelongsToMany
    {
        return $this->belongsToMany(
            IngredientSpecification::class,
            "allergen_ingredient_specifications",
        )
            ->using(AllergenIngredientSpecification::class)
            ->withPivot("is_trace");
    }
}
