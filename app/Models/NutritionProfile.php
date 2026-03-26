<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Traits\BelongsToOrganisation;

class NutritionProfile extends Model
{
    /** @use HasFactory<\Database\Factories\NutritionProfileFactory> */
    use HasFactory;
    use BelongsToOrganisation;

    protected $fillable = [
        "organisation_id",
        "name",
        "source",
        "created_by",
        "commited_by",
        "commited_at",
        "superseded_by",
        "superseded_at",
        "retired_by",
    ];

    protected $casts = [
        "commited_at" => "datetime",
        "superseded_at" => "datetime",
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
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
        return $this->belongsTo(NutritionProfile::class, "superseded_by");
    }

    public function retiredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "retired_by");
    }

    public function nutrients(): BelongsToMany
    {
        return $this->belongsToMany(
            Nutrient::class,
            "nutrient_nutrition_profiles",
        )
            ->using(NutrientNutritionProfile::class)
            ->withPivot("quantity");
    }

    public function ingredientSpecifications(): HasMany
    {
        // FK column in ingredient_specifications is 'nutrition_profile' (not the conventional 'nutrition_profile_id')
        return $this->hasMany(
            IngredientSpecification::class,
            "nutrition_profile",
        );
    }
}
