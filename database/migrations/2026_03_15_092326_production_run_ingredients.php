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
        Schema::create("production_run_ingredients", function (
            Blueprint $table,
        ) {
            $table
                ->foreignId("production_run_id")
                ->constrained("production_runs");
            $table->foreignId("delivery_id")->constrained("deliveries");
            $table
                ->foreignId("ingredient_specification_id")
                ->constrained("ingredient_specifications");
            $table->decimal("yield");
            $table->foreignId("unit_id")->constrained("units");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
