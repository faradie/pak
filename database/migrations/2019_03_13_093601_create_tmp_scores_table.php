<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTmpScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tmp_scores', function (Blueprint $table) {
            $table->string('item_id');       //item_id
            $table->string('nip');      //submission_id with nip
            $table->decimal('item_score',8,4)->nullable();  //item_score
            // $table->string('type'); //administrasi / berkas inti
            $table->timestamps();

            $table->foreign('nip')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('item_id')->references('id')->on('items')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tmp_scores');
    }
}
