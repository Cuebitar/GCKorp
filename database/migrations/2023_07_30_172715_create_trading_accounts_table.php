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
        Schema::create('trading_accounts', function (Blueprint $table) {
            $table->id('tradingAccount_id');
            $table->bigInteger('accountNo')->unique();
            $table->double('initialBalance')->default(0);
            $table->double('balance')->default(0);
            $table->string('status')->default('Pending');
            $table->timestamps();
            $table->unsignedBigInteger('userId');
            $table->foreign('userId')->references('user_id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trading_accounts');
    }
};
