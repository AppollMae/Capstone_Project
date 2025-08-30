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
        Schema::table('permit_applications', function (Blueprint $table) {
        // Update the enum to include 'under_review'
        $table->enum('status', ['pending', 'under_review', 'approved', 'rejected'])->default('pending')->change();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permit_applications', function (Blueprint $table) {
            $table->enum('status', ['pending', 'under_review', 'approved', 'rejected'])->default('pending')->change();
        });
    }
};
