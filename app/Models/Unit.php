<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Unit extends Model
{
    use HasFactory;

    protected $fillable = ["unit_name", "unit_abbreviation", "type"];

    public function nutrients(): HasMany
    {
        return $this->hasMany(Nutrient::class);
    }

    public function ingredientSpecifications(): HasMany
    {
        return $this->hasMany(IngredientSpecification::class);
    }

    public function recipeVersions(): HasMany
    {
        return $this->hasMany(RecipeVersion::class);
    }
}
