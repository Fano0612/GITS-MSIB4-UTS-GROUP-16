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
        Schema::create('userlist', function (Blueprint $table) {
        $table->id('id')->length(10);
        $table->string('username');
        $table->string('email');
        $table->string('password');
        $table->string('access_rights', 50);
        $table->string('status', 50)->default('inactive');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('userlist');
    }
};