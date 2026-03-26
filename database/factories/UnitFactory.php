<?php

namespace Database\Factories;

use App\Models\Unit;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Unit>
 */
class UnitFactory extends Factory
{
    private static array $units = [
        ["unit_name" => "Gram", "unit_abbreviation" => "g", "type" => "weight"],
        [
            "unit_name" => "Kilogram",
            "unit_abbreviation" => "kg",
            "type" => "weight",
        ],
        [
            "unit_name" => "Ounce",
            "unit_abbreviation" => "oz",
            "type" => "weight",
        ],
        [
            "unit_name" => "Pound",
            "unit_abbreviation" => "lb",
            "type" => "weight",
        ],
        [
            "unit_name" => "Millilitre",
            "unit_abbreviation" => "ml",
            "type" => "volume",
        ],
        [
            "unit_name" => "Litre",
            "unit_abbreviation" => "l",
            "type" => "volume",
        ],
        [
            "unit_name" => "Teaspoon",
            "unit_abbreviation" => "tsp",
            "type" => "volume",
        ],
        [
            "unit_name" => "Tablespoon",
            "unit_abbreviation" => "tbsp",
            "type" => "volume",
        ],
        ["unit_name" => "Each", "unit_abbreviation" => "ea", "type" => "count"],
        [
            "unit_name" => "Kilocalorie",
            "unit_abbreviation" => "kcal",
            "type" => "count",
        ],
        [
            "unit_name" => "Kilojoule",
            "unit_abbreviation" => "kJ",
            "type" => "count",
        ],
    ];

    public function definition(): array
    {
        return fake()->unique()->randomElement(self::$units);
    }

    public function weight(): static
    {
        return $this->state(
            fn(array $attributes) => [
                "type" => "weight",
            ],
        );
    }

    public function volume(): static
    {
        return $this->state(
            fn(array $attributes) => [
                "type" => "volume",
            ],
        );
    }

    public function piece(): static
    {
        return $this->state(
            fn(array $attributes) => [
                "type" => "count",
            ],
        );
    }
}
