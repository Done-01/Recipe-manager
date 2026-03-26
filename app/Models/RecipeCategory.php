<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToOrganisation;

class RecipeCategory extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeCategoryFactory> */
    use HasFactory, SoftDeletes;
    use BelongsToOrganisation;

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

    public function recipes(): HasMany
    {
        // FK column in recipes table is 'category' (not the conventional 'recipe_category_id')
        return $this->hasMany(Recipe::class, "category");
    }
}
