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
        Schema::table('userlist', function (Blueprint $table) {
            $table->integer('id_pelanggan_belanja_bantuan_karyawan')->length(10)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('userlist', function (Blueprint $table) {
            //
        });
    }
};
