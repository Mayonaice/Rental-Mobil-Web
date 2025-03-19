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
        Schema::create('master_payments', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->enum('tipe_payment', ['BCA', 'BNI', 'BRI', 'Permata', 'GoPay', 'Dana']);
            $table->string('nama_akun');
            $table->string('no_rek')->nullable();
            $table->string('no_hp')->nullable();
            $table->text('qrcode')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_payments');
    }
};
