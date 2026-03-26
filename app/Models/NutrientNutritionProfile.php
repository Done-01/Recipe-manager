<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\Pivot;

class NutrientNutritionProfile extends Pivot
{
    protected $table = 'nutrient_nutrition_profiles';

    public $timestamps = false;

    protected $fillable = [
        'nutrition_profile_id',
        'nutrient_id',
        'quantity',
    ];

    protected $casts = [
        'quantity' => 'decimal:4',
    ];

    public function nutritionProfile(): BelongsTo
    {
        return $this->belongsTo(NutritionProfile::class);
    }

    public function nutrient(): BelongsTo
    {
        return $this->belongsTo(Nutrient::class);
    }
}
