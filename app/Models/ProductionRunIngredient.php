<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class ProductionRunIngredient extends Pivot
{
    protected $table = 'production_run_ingredients';

    public $timestamps = false;

    protected $fillable = [
        'production_run_id',
        'delivery_id',
        'ingredient_specification_id',
        'yield',
        'unit_id',
    ];

    protected $casts = [
        'yield' => 'decimal:4',
    ];

    public function productionRun(): BelongsTo
    {
        return $this->belongsTo(ProductionRun::class);
    }

    public function delivery(): BelongsTo
    {
        return $this->belongsTo(Delivery::class);
    }

    public function ingredientSpecification(): BelongsTo
    {
        return $this->belongsTo(IngredientSpecification::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(Unit::class);
    }
}
