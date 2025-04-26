<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patient_services', function (Blueprint $table) {
            $table->id();
            $table->foreignId('patient_id')->constrained()->onDelete('cascade');

            // Jenis pelayanan: ANC, INC, dll
            $table->string('service_type');

            // Antrean
            $table->unsignedInteger('queue_number')->nullable();
            $table->date('queue_date')->nullable();

            // Status pelayanan
            $table->enum('status', ['Menunggu', 'Siap Diperiksa', 'Diperiksa', 'Selesai'])->default('Menunggu');
            // $table->enum('status', ['Menunggu', 'Siap Diperiksa', 'Selesai Pemeriksaan', 'Sudah Bayar'])->default('Menunggu');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patient_services');
    }
};