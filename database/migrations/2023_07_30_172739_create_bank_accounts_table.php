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
        Schema::create('bank_accounts', function (Blueprint $table) {
            $table->id('bankAccount_id');
            $table->string('bankName');
            $table->string('accountName');
            $table->string('accountNo')->unique();
            $table->string('bankStatement')->unique();
            $table->string('status');
            $table->boolean('isPrimary');
            $table->timestamps();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('verifyBy')->nullable();
            $table->unsignedBigInteger('rejectId')->nullable();
            $table->foreign('userId')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('verifyBy')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('rejectId')->references('reject_id')->on('reject_reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bank_accounts');
    }
};
