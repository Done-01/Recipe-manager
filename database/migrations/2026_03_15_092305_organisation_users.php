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
        Schema::create("organisation_users", function (Blueprint $table) {
            $table->foreignId("user_id")->constrained("users");
            $table->foreignId("organisation_id")->constrained("organisations");
            $table->enum("role", ["admin", "user"]);
            $table->timestamp("created_at");
            $table->foreignId("created_by")->constrained("users");
            $table->timestamp("updated_at")->nullable();
            $table->foreignId("updated_by")->nullable()->constrained("users");
            $table->timestamp("deleted_at")->nullable();
            $table->foreignId("deleted_by")->nullable()->constrained("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("organistaion_users");
    }
};
