<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackingTable extends Migration
{
    public function up(): void
    {
        Schema::create('tracking', function (Blueprint $table) {
            $table->id('id_tracking');
            $table->unsignedBigInteger('id_kucing');
            $table->text('laporan')->nullable(); // Laporan aktivitas harian
            $table->string('foto')->nullable(); // Path foto kucing
            $table->timestamps();

            $table->foreign('id_kucing')->references('id_kucing')->on('kucing')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tracking');
    }
}