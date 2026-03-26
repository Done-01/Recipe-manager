<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class AllergenIngredientSpecification extends Pivot
{
    protected $table = 'allergen_ingredient_specifications';

    public $timestamps = false;

    protected $fillable = [
        'allergen_id',
        'ingredient_specification_id',
        'is_trace',
    ];

    protected $casts = [
        'is_trace' => 'boolean',
    ];

    public function allergen(): BelongsTo
    {
        return $this->belongsTo(Allergen::class);
    }

    public function ingredientSpecification(): BelongsTo
    {
        return $this->belongsTo(IngredientSpecification::class);
    }
}
