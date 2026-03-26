<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "name",
        "organisation_id",
        "created_by",
        "updated_by",
        "deleted_by",
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function updatedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "updated_by");
    }

    public function deletedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "deleted_by");
    }

    public function specifications(): HasMany
    {
        return $this->hasMany(IngredientSpecification::class);
    }

    public function recipeVersions(): BelongsToMany
    {
        return $this->belongsToMany(RecipeVersion::class, "ingredient_recipe")
            ->using(RecipeIngredient::class)
            ->withPivot([
                "ingredient_specification_id",
                "quantity",
                "unit_id",
                "waste_percentage",
                "notes",
            ]);
    }
}
