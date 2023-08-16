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
        Schema::create('updates', function (Blueprint $table) {
            $table->id('updates_id');
            $table->string('statusBefore');
            $table->timestamp('updatedAt');
            $table->unsignedBigInteger('userId')->nullable();
            $table->unsignedBigInteger('tradingAccountId')->nullable();
            $table->unsignedBigInteger('transactionId')->nullable();
            $table->unsignedBigInteger('bankAccountId')->nullable();
            $table->unsignedBigInteger('updatedBy');
            $table->unsignedBigInteger('rejectId')->nullable();
            $table->foreign('userId')->references('user_id')->on('users')->onDelete('cascade');
            $table->foreign('tradingAccountId')->references('tradingAccount_id')->on('trading_accounts')->onDelete('cascade');
            $table->foreign('transactionId')->references('transaction_id')->on('transactions')->onDelete('cascade');
            $table->foreign('bankAccountId')->references('bankAccount_id')->on('bank_accounts')->onDelete('cascade');
            $table->foreign('updatedBy')->references('user_id')->on('users')->onDelete('cascade');
        //    $table->foreign('rejectId')->references('id')->on('reject_reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('updates');
    }
};
