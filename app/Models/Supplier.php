<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Supplier extends Model
{
    /** @use HasFactory<\Database\Factories\SupplierFactory> */
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        "name",
        "organisation_id",
        "address",
        "email",
        "telephone_number",
        "notes",
        "created_by",
        "superseded_by",
        "superseded_at",
        "retired_by",
    ];

    protected $casts = [
        "created_at" => "datetime",
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

    public function supersededBy(): BelongsTo
    {
        return $this->belongsTo(Supplier::class, "superseded_by");
    }

    public function retiredBy(): BelongsTo
    {
        return $this->belongsTo(User::class, "retired_by");
    }

    public function ingredientSpecifications(): HasMany
    {
        return $this->hasMany(IngredientSpecification::class);
    }

    public function deliveries(): HasMany
    {
        return $this->hasMany(Delivery::class);
    }
}
