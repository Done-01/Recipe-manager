<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Delivery extends Model
{
    /** @use HasFactory<\Database\Factories\DeliveryFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "organisation_id",
        "ingredient_specification_id",
        "supplier_id",
        "delivery_date",
        "quantity",
        "loc_code",
        "created_by",
        "commited_by",
        "commited_at",
        "superseded_by",
        "superseded_at",
        "retired_by",
    ];

    protected $casts = [
        "delivery_date" => "datetime",
        "created_at" => "datetime",
        "commited_at" => "datetime",
        "superseded_at" => "datetime",
    ];

    public function organisation(): BelongsTo
    {
        return $this->belongsTo(Organisation::class);
    }

    public function ingredientSpecification(): BelongsTo
    {
        return $this->belongsTo(IngredientSpecification::class);
    }

    public function supplier(): BelongsTo
    {
        return $this->belongsTo(Supplier::class);
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
        return $this->belongsTo(Delivery::class, "superseded_by");
    }

    public function retiredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "retired_by");
    }

    public function productionRuns(): BelongsToMany
    {
        return $this->belongsToMany(
            ProductionRun::class,
            "production_run_ingredients",
        )
            ->using(ProductionRunIngredient::class)
            ->withPivot(["ingredient_specification_id", "yield", "unit_id"]);
    }
}
