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
        Schema::create('architectural_permit_page_2', function (Blueprint $table) {
            $table->id();
            $table->string('received_by')->nullable();
            $table->date('received_date')->nullable();

            // BOX 7
            $table->json('documents')->nullable();
            $table->string('documents_others')->nullable();

            // BOX 9
            $table->string('issued_signature')->nullable();
            $table->date('issued_date')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('architectural_permit_page_2');
    }
};
