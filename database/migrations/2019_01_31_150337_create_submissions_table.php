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
            $table->string('submission_position');
            $table->string('submission_status')->nullable();
            $table->string('series_number')->nullable();
            $table->bigInteger('submission_score')->nullable();
            $table->bigInteger('team_score')->nullable();
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
