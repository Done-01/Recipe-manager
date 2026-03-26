<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class ProductionRun extends Model
{
    /** @use HasFactory<\Database\Factories\ProductionRunFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "organisation_id",
        "recipe_version_id",
        "print_count",
        "produced_at",
        "produced_count",
        "produced_yield",
        "unit_id",
    ];

    protected $casts = [
        "produced_at" => "datetime",
        "produced_yield" => "decimal:4",
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function recipeVersion(): BelongsTo
    {
        return $this->belongsTo(RecipeVersion::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }

    public function deliveries(): BelongsToMany
    {
        return $this->belongsToMany(
            Delivery::class,
            "production_run_ingredients",
        )
            ->using(ProductionRunIngredient::class)
            ->withPivot(["ingredient_specification_id", "yield", "unit_id"]);
    }
}
