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
            $table->longText('accountNo')->unique();
            $table->blob('bankStatement')->unique();
            $table->string('status');
            $table->boolean('isPrimary');
            $table->timestamps();
            $table->unsignedBigInteger('userId');
            $table->unsignedBigInteger('verifyBy')->nullable();
            $table->unsignedBigInteger('rejectId')->nullable();
            $table->foreign('userId')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('verifyBy')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('rejectId')->references('id')->on('reject_reasons')->onDelete('cascade');
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
