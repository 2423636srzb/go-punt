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
        Schema::create('user_request', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_account_id'); // Link to the user
            $table->string('status');
            $table->timestamps();
            $table->foreign('user_account_id')->references('id')->on('user_accounts')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_request');
    }
};
