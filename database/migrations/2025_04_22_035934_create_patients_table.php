<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('nik')->unique();
            $table->string('full_name');
            $table->string('phone');
            $table->date('birth_date');
            $table->enum('gender', ['Laki-laki', 'Perempuan']);
            $table->enum('marital_status', ['Belum Kawin', 'Kawin', 'Cerai Hidup', 'Cerai Mati']);
            $table->text('address');
            $table->string('province');
            $table->string('city');
            $table->string('district');
            $table->string('sub_district');
            $table->string('postal_code');
            $table->enum('insurance', ['Tidak Ada', 'BPJS', 'Asuransi Lainnya']);
            $table->enum('payment_type', ['Mandiri', 'BPJS', 'Asuransi Lainnya']);
            $table->json('other_contacts')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patients');
    }
};