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
        Schema::create('bfp_inspections', function (Blueprint $table) {
            $table->id();
             $table->unsignedBigInteger('permit_id'); // foreign key
            $table->unsignedBigInteger('inspector_id')->nullable(); // user who inspected
            $table->date('inspection_date')->nullable();
            $table->string('remarks')->nullable();
            $table->enum('result', ['compliant', 'non_compliant', 'pending'])->default('pending');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('permit_id')
                  ->references('id')
                  ->on('permit_applications')
                  ->onDelete('cascade');

            $table->foreign('inspector_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bfp_inspections');
    }
};
