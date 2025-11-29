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
        Schema::create('unified_app_form', function (Blueprint $table) {
            $table->id();
            // Application type
            $table->string('application_type')->nullable();
            $table->string('for')->nullable();
            $table->string('applies_to')->nullable();
            $table->string('area_no')->nullable();

            // Owner information
            $table->string('owner_lastname')->nullable();
            $table->string('owner_firstname')->nullable();
            $table->string('owner_mi')->nullable();
            $table->string('owner_tin')->nullable();

            // Ownership
            $table->string('owned_by')->nullable();
            $table->string('form_ownership')->nullable();

            // Address
            $table->string('owner_address')->nullable();
            $table->string('owner_city')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unified_app_form');
    }
};
