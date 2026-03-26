<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("ingredient_recipe", function (Blueprint $table) {
            $table->id();
            $table
                ->foreignId("recipe_version_id")
                ->constrained("recipe_versions");
            $table->foreignId("ingredient_id")->constrained("ingredients");
            $table
                ->foreignId("ingredient_specification_id")
                ->nullable()
                ->constrained("ingredient_specifications");
            $table->decimal("quantity");
            $table->foreignId("unit_id")->constrained("units");
            $table->decimal("waste_percentage")->nullable();
            $table->text("notes")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("ingredient_recipe");
    }
};
