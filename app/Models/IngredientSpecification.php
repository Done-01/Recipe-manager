<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class IngredientSpecification extends Model
{
    /** @use HasFactory<\Database\Factories\IngredientSpecificationFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "ingredient_id",
        "organisation_id",
        "supplier_id",
        "nutrition_profile",
        "cost_per_item",
        "item_size",
        "unit_id",
        "created_by",
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
        "cost_per_item" => "integer",
        "item_size" => "decimal:4",
    ];

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class);
    }

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
    }

    public function nutritionProfile(): BelongsTo
    {
        // FK column is 'nutrition_profile' (not the conventional 'nutrition_profile_id')
        return $this->belongsTo(NutritionProfile::class, "nutrition_profile");
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

    public function supersededBy(): BelongsTo
    {
        return $this->belongsTo(
            IngredientSpecification::class,
            "superseded_by",
        );
    }

    public function retiredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "retired_by");
    }

    public function allergens(): BelongsToMany
    {
        return $this->belongsToMany(
            Allergen::class,
            "allergen_ingredient_specifications",
        )
            ->using(AllergenIngredientSpecification::class)
            ->withPivot("is_trace");
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }
}
