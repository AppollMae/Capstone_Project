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
        Schema::table('issue_permit_flags', function (Blueprint $table) {
            $table->unsignedBigInteger('reported_by')->after('issue')->nullable();
            $table->foreign('reported_by')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issue_permit_flags', function (Blueprint $table) {
            $table->dropColumn('reported_by');
        });
    }
};
