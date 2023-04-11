<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->BigInteger('transaction_id');
            $table->foreignId('user_id');
            $table->foreignId('product_id');
            $table->string('product_name');
            $table->string('product_picture');
            $table->integer('quantity')->default(1);
            $table->string('transaction_status');
            $table->BigInteger('product_price')->length(50);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transactions');
    }
};
