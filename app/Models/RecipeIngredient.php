<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class RecipeIngredient extends Pivot
{
    protected $table = "ingredient_recipe";

    public $timestamps = false;

    protected $fillable = [
        "recipe_version_id",
        "ingredient_id",
        "ingredient_specification_id",
        "quantity",
        "unit_id",
        "waste_percentage",
        "notes",
    ];

    protected $casts = [
        "quantity" => "decimal:4",
        "waste_percentage" => "decimal:2",
    ];

    public function recipeVersion(): BelongsTo
    {
        return $this->belongsTo(RecipeVersion::class);
    }

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function ingredientSpecification(): BelongsTo
    {
        return $this->belongsTo(IngredientSpecification::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
