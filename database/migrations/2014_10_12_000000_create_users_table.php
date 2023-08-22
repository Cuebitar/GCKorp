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
        Schema::create('users', function (Blueprint $table) {
            $table->id('user_id');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('IC')->unique();
            $table->string('ICDocument')->unique();
            $table->enum('gender', ['male', 'female']);
            $table->string('religion');
            $table->string('race');
            $table->enum('userType', ['guest', 'member','super_admin', 'admin_staff', 'operation_staff', 'super_operation_staff', 'account_staff']);
            $table->string('status');
            $table->String('address');
            $table->boolean('isVerified');
            $table->timestamps();
            $table->unsignedBigInteger('rejectId')->nullable();
           // $table->foreign('rejectId')->references('id')->on('reject_reasons')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
