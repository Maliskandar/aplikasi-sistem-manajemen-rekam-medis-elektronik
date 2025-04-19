<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKucingTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kucing', function (Blueprint $table) {
            $table->id('id_kucing');
            $table->string('nama');
            $table->string('ras');
            $table->text('info_kesehatan');
            $table->unsignedBigInteger('id_customer');
            $table->timestamps();

            // Relasi ke tabel customer
            $table->foreign('id_customer')->references('id_customer')->on('customer')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kucing');
    }
}