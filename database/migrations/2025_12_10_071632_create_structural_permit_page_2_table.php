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
        Schema::create('structural_permit_page_2', function (Blueprint $table) {
            $table->id();
            // BOX 7
            $table->string('received_by')->nullable();
            $table->date('received_date')->nullable();
            $table->json('documents')->nullable();
            $table->string('documents_others')->nullable();

            // BOX 8 – CIVIL
            $table->date('civil_in_date')->nullable();
            $table->time('civil_in_time')->nullable();
            $table->date('civil_out_date')->nullable();
            $table->time('civil_out_time')->nullable();
            $table->string('civil_processed_by')->nullable();

            // BOX 8 – OTHERS
            $table->date('other_in_date')->nullable();
            $table->time('other_in_time')->nullable();
            $table->date('other_out_date')->nullable();
            $table->time('other_out_time')->nullable();
            $table->string('other_processed_by')->nullable();

            // BOX 9
            $table->string('permit_issued_by')->nullable();
            $table->date('permit_issued_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('structural_permit_page_2');
    }
};
