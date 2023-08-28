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
        Schema::create('reject_reasons', function (Blueprint $table) {
            $table->id('reject_id');
            $table->enum('rejectType',['User', 'Bank Account', 'Transaction']);
            $table->string('rejectCode');
            $table->longText('description');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reject_reasons');
    }
};
