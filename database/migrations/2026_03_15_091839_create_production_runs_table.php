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
        Schema::create("production_runs", function (Blueprint $table) {
            $table->id();
            $table->foreignId("organisation_id")->constrained("organisations");
            $table
                ->foreignId("recipe_version_id")
                ->constrained("recipe_versions");
            $table->integer("print_count");
            $table->dateTime("produced_at");
            $table->integer("produced_count");
            $table->decimal("produced_yield");
            $table->foreignId("unit_id")->constrained("units");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("production_runs");
    }
};
