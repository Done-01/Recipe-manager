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
        Schema::create("nutrition_profiles", function (Blueprint $table) {
            $table->id();
            $table->foreignId("organisation_id")->constrained("organisations");
            $table->string("name");
            $table->enum("source", [
                "manual",
                "supplier_spec",
                "mccance",
                "library",
                "partner",
            ]);
            $table->foreignId("created_by")->constrained("users");
            $table->foreignId("commited_by")->nullable()->constrained("users");
            $table->timestamp("commited_at")->nullable();
            $table
                ->foreignId("superseded_by")
                ->nullable()
                ->constrained("nutrition_profiles");
            $table->timestamp("superseded_at")->nullable();
            $table->foreignId("retired_by")->nullable()->constrained("users");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("nutrition_profiles");
    }
};
