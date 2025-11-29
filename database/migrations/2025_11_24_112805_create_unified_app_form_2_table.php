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
        Schema::create('unified_app_form_2', function (Blueprint $table) {
            $table->id();

            // Foreign key to unified_app_form
            $table->foreignId('unified_app_form_id')
                ->constrained('unified_app_form')
                ->onDelete('cascade'); // deletes related records if parent is deleted
            $table->string('owner_zip')->nullable();
            $table->string('owner_contact')->nullable();

            // Location
            $table->string('location_street')->nullable();
            $table->string('location_barangay')->nullable();
            $table->string('location_city')->nullable();
            $table->string('tax_dec_no')->nullable();

            // Construction
            $table->string('construction')->nullable();
            $table->string('construction_others')->nullable();

            // Occupancy
            $table->string('occupancy')->nullable();

            // Area and Cost
            $table->decimal('floor_area', 10, 2)->nullable();
            $table->decimal('lot_area', 10, 2)->nullable();
            $table->decimal('estimated_cost', 15, 2)->nullable();
            $table->date('expected_completion')->nullable();

            // Inspector / Architect / Engineer
            $table->string('inspector_name')->nullable();
            $table->string('inspector_address')->nullable();
            $table->string('engineer_name')->nullable();
            $table->string('prc_no')->nullable();
            $table->string('ptr_no')->nullable();
            $table->string('validity')->nullable();

            // Applicant info
            $table->string('applicant_signature')->nullable();
            $table->date('applicant_date')->nullable();
            $table->string('applicant_id_no')->nullable();
            $table->string('applicant_place_issued')->nullable();

            // Lot owner info
            $table->string('lot_owner_signature')->nullable();
            $table->date('lot_owner_date')->nullable();
            $table->string('lot_owner_id_no')->nullable();
            $table->string('lot_owner_place_issued')->nullable();

            // Notary info
            $table->string('notary_applicant_name')->nullable();
            $table->string('notary_applicant_id_no')->nullable();
            $table->date('notary_applicant_date_issued')->nullable();
            $table->string('notary_public')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('unified_app_form_2');
    }
};
