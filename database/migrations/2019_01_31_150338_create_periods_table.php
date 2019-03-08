<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeriodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('periods', function (Blueprint $table) {
            $table->string('submission_id');
            $table->string('nip');
            $table->date('starts');
            $table->date('ends');
            $table->timestamps();

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
        Schema::dropIfExists('periods');
    }
}
