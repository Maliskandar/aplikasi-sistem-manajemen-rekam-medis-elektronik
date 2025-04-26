<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('anc_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_service_id')->constrained()->onDelete('cascade');

            $table->date('hpht')->nullable();
            $table->text('keluhan_saat_ini')->nullable();
            $table->text('riwayat_kehamilan')->nullable();
            $table->text('riwayat_persalinan')->nullable();
            $table->text('riwayat_abortus')->nullable();
            $table->text('riwayat_penyakit_keluarga')->nullable();
            $table->string('bmi')->nullable();

            // Tambahan pemeriksaan fisik & penunjang
            $table->string('tekanan_darah')->nullable();
            $table->string('tinggi_fundus')->nullable();
            $table->string('denyut_janin')->nullable();
            $table->string('lingkar_lengan_atas')->nullable();
            $table->string('berat_badan')->nullable();
            $table->string('tinggi_badan')->nullable();
            $table->text('catatan')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anc_records');
    }
};