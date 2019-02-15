<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSubmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('submissions', function (Blueprint $table) {
            $table->string('id')->unique()->primary();
            $table->string('nip');
            $table->string('submission_position');              //posisi file pengajuan
            $table->string('submission_status')->nullable();        //hold or done
            $table->string('series_number')->nullable();              //nomor seri pengajuan
            $table->bigInteger('submission_score')->nullable();     //nilai dupak sebelum dikoreksi tim penilai
            $table->bigInteger('team_score')->nullable();   //penilaian dari tim sesudah dikoreksi
            $table->string('SKFileUrl')->nullable();     //untuk link SK per pengajuan
            $table->timestamps();

            $table->foreign('nip')->references('id')->on('users')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('submissions');
    }
}
