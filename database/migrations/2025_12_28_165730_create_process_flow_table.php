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
        Schema::create('process_flow', function (Blueprint $table) {
            $table->id();
            $table->foreignId('architectural_permit_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('office_section');
            $table->date('in_date')->nullable();
            $table->time('in_time')->nullable();
            $table->date('out_date')->nullable();
            $table->time('out_time')->nullable();
            $table->string('processed_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('process_flow');
    }
};
