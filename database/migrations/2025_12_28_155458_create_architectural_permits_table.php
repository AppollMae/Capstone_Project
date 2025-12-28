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
        Schema::create('architectural_permits', function (Blueprint $table) {
            $table->id();
            // Permit Numbers
            $table->string('application_no')->nullable();
            $table->string('ap_no')->nullable();
            $table->string('building_permit_no')->nullable();

            // Owner / Applicant
            $table->string('owner_last_name')->nullable();
            $table->string('owner_first_name')->nullable();
            $table->string('owner_middle_initial')->nullable();
            $table->string('ownership_form')->nullable();
            $table->string('occupancy_use')->nullable();
            $table->text('address')->nullable();
            $table->string('telephone')->nullable();

            // Scope of Work (checkboxes)
            $table->json('scope')->nullable();

            // Design Professional
            $table->string('architect_name')->nullable();
            $table->string('architect_prc')->nullable();
            $table->string('architect_ptr')->nullable();

            // Supervisor
            $table->string('supervisor_name')->nullable();
            $table->string('supervisor_prc')->nullable();

            // Signatures
            $table->string('building_owner_signature')->nullable();
            $table->string('lot_owner_signature')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('architectural_permits');
    }
};
