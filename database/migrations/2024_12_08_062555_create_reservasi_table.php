<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Facade;

class CreateReservasiTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('reservasi', function (Blueprint $table) {
            $table->id('id_reservasi');
            $table->unsignedBigInteger('id_customer');
            $table->unsignedBigInteger('id_kucing');
            $table->unsignedBigInteger('id_kandang');
            $table->string('status'); // Contoh: Pending, Selesai
            $table->string('status_pembayaran'); // Contoh: Lunas, Belum Dibayar
            $table->date('tanggal_reservasi'); // Tanggal mulai reservasi
            $table->date('tanggal_selesai')->nullable();
            $table->timestamps();

            // Relasi ke tabel customer, kucing, dan kandang
            $table->foreign('id_customer')->references('id_customer')->on('customer')->onDelete('cascade');
            $table->foreign('id_kucing')->references('id_kucing')->on('kucing')->onDelete('cascade');
            $table->foreign('id_kandang')->references('id_kandang')->on('kandang')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reservasi');
    }
}