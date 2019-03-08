<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDupakItemScoresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dupak_item_scores', function (Blueprint $table) {
            $table->string('team_id');
            $table->string('_item_id');
            $table->string('submission_id');
            $table->string('nip');
            $table->decimal('item_score',8,4)->nullable();
            $table->bigInteger('times')->nullable();
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
        Schema::dropIfExists('dupak_item_scores');
    }
}
