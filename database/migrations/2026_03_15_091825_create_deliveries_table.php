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
        Schema::create("deliveries", function (Blueprint $table) {
            $table->id();
            $table->foreignId("organisation_id")->constrained("organisations");
            $table
                ->foreignId("ingredient_specification_id")
                ->constrained("ingredient_specifications");
            $table->foreignId("supplier_id")->constrained("suppliers");
            $table->dateTime("delivery_date");
            $table->integer("quantity");
            $table->string("loc_code");
            $table->foreignId("created_by")->constrained("users");
            $table->timestamp("created_at");
            $table->foreignId("commited_by")->nullable()->constrained("users");
            $table->timestamp("commited_at")->nullable();
            $table
                ->foreignId("superseded_by")
                ->nullable()
                ->constrained("deliveries");
            $table->timestamp("superseded_at")->nullable();
            $table->foreignId("retired_by")->nullable()->constrained("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("deliveries");
    }
};
