<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('customer', function (Blueprint $table) {
            $table->id('id_customer');
            $table->string('nama');
            $table->string('info_kontak');
            $table->string('email')->unique();
            $table->timestamps();
        });

        Schema::table('customer', function (Blueprint $table) {
            $table->foreign('id_customer')->references('id')->on('users')->onDelete('cascade');
        });

        // Set the auto-increment starting value to 2
        DB::statement('ALTER TABLE customer AUTO_INCREMENT = 2');
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('customer');
    }
}