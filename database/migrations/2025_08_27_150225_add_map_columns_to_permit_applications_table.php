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
            $table->string('address')->nullable()->after('location'); // Full address input
            $table->decimal('latitude', 10, 7)->nullable()->after('address'); // e.g. 14.5995
            $table->decimal('longitude', 10, 7)->nullable()->after('latitude'); // e.g. 120.9842
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permit_applications', function (Blueprint $table) {
            $table->dropColumn(['address', 'latitude', 'longitude']);
        });
    }
};
