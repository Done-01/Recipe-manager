<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Traits\BelongsToOrganisation;

class Recipe extends Model
{
    /** @use HasFactory<\Database\Factories\RecipeFactory> */
    use HasFactory, SoftDeletes;
    use BelongsToOrganisation;
    protected $fillable = [
        "name",
        "organisation_id",
        "category",
        "created_by",
        "updated_by",
        "deleted_by",
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    /**
     * The FK column in the migration is 'category' (not the conventional 'recipe_category_id').
     * Named recipeCategory() to avoid collision with the raw 'category' attribute.
     */
    public function recipeCategory(): BelongsTo
    {
        return $this->belongsTo(RecipeCategory::class, "category");
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

    public function versions(): HasMany
    {
        return $this->hasMany(RecipeVersion::class);
    }
}
