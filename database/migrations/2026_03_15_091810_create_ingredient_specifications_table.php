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
        Schema::create("ingredient_specifications", function (
            Blueprint $table,
        ) {
            $table->id();
            $table->foreignId("ingredient_id")->constrained("ingredients");
            $table->foreignId("organisation_id")->constrained("organisations");
            $table->foreignId("supplier_id")->constrained("suppliers");
            $table
                ->foreignId("nutrition_profile")
                ->constrained("nutrition_profiles");
            $table->integer("cost_per_item");
            $table->decimal("item_size");
            $table->foreignId("unit_id")->constrained("units");
            $table->foreignId("created_by")->constrained("users");
            $table->timestamp("created_at");
            $table->foreignId("commited_by")->nullable()->constrained("users");
            $table->timestamp("commited_at")->nullable();
            $table
                ->foreignId("superseded_by")
                ->nullable()
                ->constrained("ingredient_specifications");
            $table->timestamp("superseded_at")->nullable();
            $table->foreignId("retired_by")->nullable()->constrained("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("ingredient_specifications");
    }
};
