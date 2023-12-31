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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id('transaction_id');
            $table->double('amount');
            $table->string('status');
            $table->enum('type', ['deposit', 'withdrawal', 'dividen']);
            $table->longText('transactionPurpose');
            $table->string('referenceId')->unique()->comment('Auto generated by company and need to be unique');
            $table->timestamp('completedAt')->nullable();
            $table->timestamps();
            $table->unsignedBigInteger('tradingAccountId');
            $table->unsignedBigInteger('bankAccountId')->nullable();
            $table->unsignedBigInteger('rejectId')->nullable();
            $table->unsignedBigInteger('completedBy')->nullable();
            $table->foreign('tradingAccountId')->references('tradingAccount_id')->on('trading_accounts')->onDelete('cascade');
            $table->foreign('bankAccountId')->references('bankAccount_id')->on('bank_accounts')->onDelete('cascade');
            $table->foreign('rejectId')->references('reject_id')->on('reject_reasons')->onDelete('cascade');
            $table->foreign('completedBy')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
