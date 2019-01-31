<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTeamDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('team_details', function (Blueprint $table) {
            $table->string('team_id');
            $table->string('nip');
            $table->string('submission_id');
            $table->string('position');
            $table->bigInteger('individual_score');

            $table->foreign('team_id')->references('id')->on('teams')->onDelete('CASCADE');
            $table->foreign('nip')->references('id')->on('users')->onDelete('CASCADE');
            $table->foreign('submission_id')->references('id')->on('submissions')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('team_details');
    }
}
