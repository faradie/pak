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
            $table->string('type');
            $table->decimal('item_score',8,4)->nullable();
            $table->bigInteger('times')->nullable();
            $table->timestamps();

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('CASCADE');
            $table->foreign('_item_id')->references('id')->on('items')->onDelete('CASCADE');
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('CASCADE');
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
        Schema::dropIfExists('dupak_item_scores');
    }
}
