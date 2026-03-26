<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Organisation extends Model
{
    /** @use HasFactory<\Database\Factories\OrganisationFactory> */
    use HasFactory, SoftDeletes;

    protected $fillable = [
        "organisation_name",
        "created_by",
        "updated_by",
        "deleted_by",
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class, "organisation_users")
            ->using(OrganisationUser::class)
            ->withPivot(["role", "created_by", "updated_by", "deleted_by"])
            ->withTimestamps();
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

    public function ingredients(): HasMany
    {
        return $this->hasMany(Ingredient::class);
    }

    public function suppliers(): HasMany
    {
        return $this->hasMany(Supplier::class);
    }

    public function recipeCategories(): HasMany
    {
        return $this->hasMany(RecipeCategory::class);
    }

    public function recipes(): HasMany
    {
        return $this->hasMany(Recipe::class);
    }

    public function nutritionProfiles(): HasMany
    {
        return $this->hasMany(NutritionProfile::class);
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }

    public function productionRuns(): HasMany
    {
        return $this->hasMany(ProductionRun::class);
    }
}
