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
        Schema::create("suppliers", function (Blueprint $table) {
            $table->id();
            $table->string("name");
            $table->foreignId("organisation_id")->constrained("organisations");
            $table->text("address")->nullable();
            $table->string("email")->nullable();
            $table->string("telephone_number");
            $table->text("notes")->nullable();
            $table->foreignId("created_by")->constrained("users");
            $table->timestamp("created_at");
            $table
                ->foreignId("superseded_by")
                ->nullable()
                ->constrained("suppliers");
            $table->timestamp("superseded_at")->nullable();
            $table->foreignId("retired_by")->nullable()->constrained("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("suppliers");
    }
};
