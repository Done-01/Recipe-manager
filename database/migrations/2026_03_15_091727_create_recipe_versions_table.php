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
        Schema::create("recipe_versions", function (Blueprint $table) {
            $table->id();
            $table->foreignId("organisation_id")->constrained("organisations");
            $table->foreignId("recipe_id")->constrained("recipes");
            $table->string("version");
            $table->string("name");
            $table->text("description")->nullable();
            $table->enum("status", ["current", "draft"]); // might need removing
            $table->integer("count")->nullable();
            $table->decimal("yield")->nullable();
            $table->foreignId("unit_id")->nullable()->constrained("units");
            $table->text("changelog")->nullable();
            $table->foreignId("created_by")->constrained("users");
            $table->timestamp("created_at");
            $table->foreignId("commited_by")->nullable()->constrained("users");
            $table->timestamp("commited_at")->nullable();
            $table
                ->foreignId("superseded_by")
                ->nullable()
                ->constrained("recipe_versions");
            $table->timestamp("superseded_at")->nullable();
            $table->foreignId("retired_by")->nullable()->constrained("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("recipe_versions");
    }
};
