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
        Schema::create('structural_permit', function (Blueprint $table) {
            $table->id();
            // Application numbers
            $table->string('application_no')->nullable();
            $table->string('csp_no')->nullable();
            $table->string('building_permit_no')->nullable();

            // Owner / Applicant (BOX 1)
            $table->string('owner_lastname')->nullable();
            $table->string('owner_firstname')->nullable();
            $table->string('owner_mi')->nullable();
            $table->string('owner_tin')->nullable();
            $table->string('form_ownership')->nullable();
            $table->string('occupancy')->nullable();

            // Owner Address
            $table->string('owner_no')->nullable();
            $table->string('owner_street')->nullable();
            $table->string('owner_barangay')->nullable();
            $table->string('owner_city')->nullable();
            $table->string('owner_zip')->nullable();
            $table->string('owner_tel')->nullable();

            // Construction Address
            $table->string('lot_no')->nullable();
            $table->string('blk_no')->nullable();
            $table->string('tct_no')->nullable();
            $table->string('tax_dec_no')->nullable();
            $table->string('construction_street')->nullable();
            $table->string('construction_barangay')->nullable();
            $table->string('construction_city')->nullable();

            // Scope of work (checkbox array stored as JSON)
            $table->json('scope')->nullable();
            $table->string('scope_others')->nullable();
            $table->string('scope_accessory')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structural_permit');
    }
};
