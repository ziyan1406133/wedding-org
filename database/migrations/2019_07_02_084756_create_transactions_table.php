<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id');
            $table->integer('bank_id')->nullable();
            $table->string('invoice');
            $table->string('rekening')->nullable();
            $table->string('atas_nama')->nullable();
            $table->string('image')->nullable();
            $table->enum('status', ['Sudah Dibayar', 'Belum Upload Bukti'])->default('Belum Upload Bukti');
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
}
