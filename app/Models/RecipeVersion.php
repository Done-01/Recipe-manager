<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\BelongsToOrganisation;

class RecipeVersion extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeVersionFactory> */
    use HasFactory;
    use BelongsToOrganisation;

    public $timestamps = false;

    protected $fillable = [
        "recipe_id",
        "organisation_id",
        "version",
        "name",
        "description",
        "status",
        "count",
        "yield",
        "unit_id",
        "changelog",
        "created_by",
        "created_at",
        "commited_by",
        "commited_at",
        "superseded_by",
        "superseded_at",
        "retired_by",
    ];

    protected $casts = [
        "created_at" => "datetime",
        "commited_at" => "datetime",
        "superseded_at" => "datetime",
        "yield" => "decimal:4",
    ];

    public function recipe(): BelongsTo
    {
        return $this->belongsTo(Recipe::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "created_by");
    }

    public function commitedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "commited_by");
    }

    /**
     * Self-referential: the RecipeVersion that superseded this one.
     */
    public function supersededBy(): BelongsTo
    {
        return $this->belongsTo(RecipeVersion::class, "superseded_by");
    }

    public function retiredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "retired_by");
    }

    public function ingredients(): BelongsToMany
    {
        return $this->belongsToMany(Ingredient::class, "ingredient_recipe")
            ->using(RecipeIngredient::class)
            ->withPivot([
                "ingredient_specification_id",
                "quantity",
                "unit_id",
                "waste_percentage",
                "notes",
            ]);
    }

    public function productionRuns(): HasMany
    {
        return $this->hasMany(ProductionRun::class, "recipe_version_id");
    }

    public function recipeIngredients(): HasMany
    {
        return $this->hasMany(RecipeIngredient::class, "recipe_version_id");
    }
}
