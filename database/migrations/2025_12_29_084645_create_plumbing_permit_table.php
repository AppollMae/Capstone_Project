<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('plumbing_permit', function (Blueprint $table) {
            $table->id();
            // Permit Numbers
            $table->string('application_no')->nullable();
            $table->string('pp_no')->nullable();
            $table->string('building_permit_no')->nullable();

            // BOX 1
            $table->string('last_name')->nullable();
            $table->string('first_name')->nullable();
            $table->string('middle_initial')->nullable();
            $table->string('tin')->nullable();
            $table->string('ownership')->nullable();
            $table->string('occupancy')->nullable();
            $table->string('address')->nullable();
            $table->string('telephone')->nullable();

            // Scope of Work
            $table->json('scope_of_work')->nullable();
            $table->string('scope_others')->nullable();

            // Fixtures
            $table->json('fixtures')->nullable();

            // Box 3 & 4
            $table->string('designer_name')->nullable();
            $table->string('designer_prc')->nullable();
            $table->string('designer_ptr')->nullable();

            $table->string('supervisor_name')->nullable();
            $table->string('supervisor_prc')->nullable();

            // Box 5 & 6
            $table->string('owner_signature')->nullable();
            $table->string('lot_owner_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plumbing_permit');
    }
};
