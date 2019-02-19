<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('files', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->string('submission_id');
            $table->string('fileUrl');
            $table->decimal('file_size',8,2)->nullable();
            $table->string('data_status')->nullable(); //for team coment
            $table->bigInteger('times'); //pengali
            $table->string('type'); //administrasi / berkas inti
            $table->timestamps();

            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('CASCADE');
            $table->foreign('id')->references('id')->on('items')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files');
    }
}
