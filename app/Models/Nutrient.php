<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Nutrient extends Model
{
    protected $fillable = ["nutrient_name", "unit_id", "display_order"];

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function nutritionProfiles(): BelongsToMany
    {
        return $this->belongsToMany(
            NutritionProfile::class,
            "nutrient_nutrition_profiles",
        )
            ->using(NutrientNutritionProfile::class)
            ->withPivot("quantity");
    }
}
