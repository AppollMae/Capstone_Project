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
        Schema::create('bfp_inspector', function (Blueprint $table) {
            $table->id();
            $table->string('inspector_name');
            $table->string('position');
            $table->string('badge_number')->unique()->nullable();
            $table->string('phone')->nullable();
            $table->string('station')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bfp_inspector');
    }
};
