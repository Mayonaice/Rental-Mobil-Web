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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('rental_id')->constrained();
            $table->foreignId('master_payment_id')->constrained();
            $table->string('nama_akun');
            $table->string('no_rek')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('status', ['NEW', 'WAITING_CONFIRMED', 'CONFIRMED']);
            $table->text('bukti_pembayaran')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
