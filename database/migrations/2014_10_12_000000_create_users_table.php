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
            $table->string('id')->unique()->primary();
            $table->string('nama');
            $table->string('email');
            $table->string('password');
            $table->string('address');
            $table->string('CardSerialNumber')->nullable()->default(null);
            $table->bigInteger('credit')->nullable()->default(null);
            $table->string('lastSKUrl')->nullable()->default(null);
            $table->string('education')->nullable()->default(null);
            $table->string('religion')->nullable()->default(null);
            $table->string('pkPosition')->nullable();
            // $table->string('Masa Kerja Golongan Lama');
            // $table->string('Masa Kerja Golongan Baru');
            $table->string('birth_place')->nullable()->default(null);
            $table->date('birth_date')->nullable()->default(null);
            $table->string('gender')->nullable()->default(null);
            $table->string('photoUrl')->nullable();
            $table->string('is_approved')->default('0');
            $table->string('unit')->nullable();
            $table->rememberToken();
            $table->timestamps();

            $table->foreign('unit')->references('id')->on('units')->onDelete('CASCADE');
            $table->foreign('pkPosition')->references('id')->on('pk_positions')->onDelete('CASCADE');
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
