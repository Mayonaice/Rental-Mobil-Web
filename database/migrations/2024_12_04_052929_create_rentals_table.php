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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('product_id')->constrained()->onDelete('cascade');
            $table->enum('status', ['NEW', 'WAITING_PAYMENT', 'WAITING_PAYMENT_CONFIRM', 'ON_RENTAL', 'WAITING_PENGEMBALIAN', 'WAITING_PENGEMBALIAN_CONFIRMED' , 'DONE', 'EXPIRED'])->default('NEW');
            $table->integer('unit_pinjam')->default(1);
            $table->date('waktu_pinjam');
            $table->date('waktu_pengembalian');
            $table->string('total_harga');
            $table->text('bukti_pengembalian')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rental');
    }
};
