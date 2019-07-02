<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('bank_id')->nullable();
            $table->string('name');
            $table->string('username')->unique();
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->string('mobile_no')->nullable();
            $table->string('address')->nullable();
            $table->string('district_id')->nullable();
            $table->string('regency_id')->nullable();
            $table->string('province_id')->nullable();
            $table->string('avatar')->default('no_avatar.png');
            $table->string('legal_doc')->nullable();
            $table->string('rekening')->nullable();
            $table->string('atas_nama')->nullable();
            $table->enum('role', ['Admin', 'Wedding Organizer', 'Customer']);
            $table->enum('status', ['Terverifikasi', 'Belum Terverifikasi'])->default('Belum Terverifikasi');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
