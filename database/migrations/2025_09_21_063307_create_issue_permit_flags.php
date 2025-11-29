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
        Schema::create('issue_permit_flags', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('permit_id'); // linked to permit
            $table->unsignedBigInteger('user_id');   // BFP reviewer/admin who flagged
            $table->text('issue');
            $table->foreign('permit_id')->references('id')->on('permit_applications')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issue_permit_flags');
    }
};
