<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id('id_pembayaran');
            $table->unsignedBigInteger('id_reservasi');
            $table->decimal('jumlah', 10, 2);
            $table->string('metode_pembayaran');
            $table->string('status_pembayaran');
            $table->timestamps();

            // Relasi ke tabel reservasi
            $table->foreign('id_reservasi')->references('id_reservasi')->on('reservasi')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
}