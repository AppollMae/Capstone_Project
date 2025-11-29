<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permit_action_histories', function (Blueprint $table) {
            $table->unsignedBigInteger('permit_id');
            $table->unsignedBigInteger('user_id'); // who reviewed
            $table->string('action'); // approve, reject, under review, temp delete
        
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
        Schema::dropIfExists('permit_action_histories');
    }
};
