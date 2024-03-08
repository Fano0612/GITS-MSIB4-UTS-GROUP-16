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
        Schema::create('barang', function (Blueprint $table) {
            $table->integer('id_barang')->length(10);
            $table->string('namabarang')->length(255);
            $table->string('jenisbarang')->length(70);
            $table->string('deskripsi')->length(500);
            $table->string('komposisi')->length(500);
            $table->string('tanggalkedaluwarsa')->length(70);
            $table->string('foto')->length(500);
            $table->integer('jumlahstokbarang')->length(10);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang');
    }
};




