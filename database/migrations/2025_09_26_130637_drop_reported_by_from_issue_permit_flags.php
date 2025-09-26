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
            // If column has foreign key, drop foreign first
            if (Schema::hasColumn('issue_permit_flags', 'reported_by')) {
                $table->dropForeign(['reported_by']); // only if FK exists
                $table->dropColumn('reported_by');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('issue_permit_flags', function (Blueprint $table) {
            if (!Schema::hasColumn('issue_permit_flags', 'reported_by')) {
                $table->unsignedBigInteger('reported_by')->nullable()->after('issue');
                // If foreign key is needed, add it back here:
                // $table->foreign('reported_by')->references('id')->on('users')->onDelete('cascade');
            }
        });
    }
};
