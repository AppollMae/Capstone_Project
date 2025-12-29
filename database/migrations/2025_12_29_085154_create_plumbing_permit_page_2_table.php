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
        Schema::create('plumbing_permit_page_2', function (Blueprint $table) {
            $table->id();
            $table->string('received_by')->nullable();
            $table->date('received_date')->nullable();
            $table->boolean('plan')->default(false);
            $table->boolean('bom')->default(false);
            $table->boolean('cost')->default(false);
            $table->string('others')->nullable();
            // Optional: for BOX 8 you can store JSON
            $table->json('progress_flow')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plumbing_permit_page_2');
    }
};
