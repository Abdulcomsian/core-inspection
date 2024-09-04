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
        Schema::create('disbursements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('appointment_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->longText('location')->nullable();
            $table->integer('status')->nullable();
            $table->integer('phone_number')->nullable();
            $table->decimal('withdraw_amount', 10, 2)->nullable();
            $table->decimal('commission_amount', 10, 2)->nullable();
            $table->string('transaction_status')->nullable();
            $table->longText('reference_id')->nullable();
            $table->foreign('appointment_id')->references('id')->on('appointments')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('disbursements');
    }
};
